<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FTP Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/ftp.html
 */
class CI_FTP {

	/**
	 * FTP Server hostname
	 *
	 * @var	string
	 */
	public $hostname = '';

	/**
	 * FTP Username
	 *
	 * @var	string
	 */
	public $username = '';

	/**
	 * FTP Password
	 *
	 * @var	string
	 */
	public $password = '';

	/**
	 * FTP Server port
	 *
	 * @var	int
	 */
	public $port = 21;

	/**
	 * Passive mode flag
	 *
	 * @var	bool
	 */
	public $passive = TRUE;

	/**
	 * Debug flag
	 *
	 * Specifies whether to display error messages.
	 *
	 * @var	bool
	 */
	public $debug = FALSE;

	// --------------------------------------------------------------------

	/**
	 * Connection ID
	 *
	 * @var	resource
	 */
	protected $conn_id;

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function __construct($config = array())
	{
		empty($config) OR $this->initialize($config);
		log_message('info', 'FTP Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @param	array	$config
	 * @return	void
	 */
	public function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}

		// Prep the hostname
		$this->hostname = preg_replace('|.+?://|', '', $this->hostname);
	}

	// --------------------------------------------------------------------

	/**
	 * FTP Connect
	 *
	 * @param	array	 $config	Connection values
	 * @return	bool
	 */
	public function connect($config = array())
	{
		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		if (FALSE === ($this->conn_id = @ftp_connect($this->hostname, $this->port)))
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_connect');
			}

			return FALSE;
		}

		if ( ! $this->_login())
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_login');
			}

			return FALSE;
		}

		// Set passive mode if needed
		if ($this->passive === TRUE)
		{
			ftp_pasv($this->conn_id, TRUE);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * FTP Login
	 *
	 * @return	bool
	 */
	protected function _login()
	{
		return @ftp_login($this->conn_id, $this->username, $this->password);
	}

	// --------------------------------------------------------------------

	/**
	 * Validates the connection ID
	 *
	 * @return	bool
	 */
	protected function _is_conn()
	{
		if ( ! is_resource($this->conn_id))
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_no_connection');
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Change directory
	 *
	 * The second parameter lets us momentarily turn off debugging so that
	 * this function can be used to test for the existence of a folder
	 * without throwing an error. There's no FTP equivalent to is_dir()
	 * so we do it by trying to change to a particular directory.
	 * Internally, this parameter is only used by the "mirror" function below.
	 *
	 * @param	string	$path
	 * @param	bool	$suppress_debug
	 * @return	bool
	 */
	public function changedir($path, $suppress_debug = FALSE)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_chdir($this->conn_id, $path);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE && $suppress_debug === FALSE)
			{
				$this->_error('ftp_unable_to_changedir');
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Create a directory
	 *
	 * @param	string	$path
	 * @param	int	$permissions
	 * @return	bool
	 */
	public function mkdir($path, $permissions = NULL)
	{
		if ($path === '' OR ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_mkdir($this->conn_id, $path);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_mkdir');
			}

			return FALSE;
		}

		// Set file permissions if needed
		if ($permissions !== NULL)
		{
			$this->chmod($path, (int) $permissions);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Upload a file to the server
	 *
	 * @param	string	$locpath
	 * @param	string	$rempath
	 * @param	string	$mode
	 * @param	int	$permissions
	 * @return	bool
	 */
	public function upload($locpath, $rempath, $mode = 'auto', $permissions = NULL)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		if ( ! file_exists($locpath))
		{
			$this->_error('ftp_no_source_file');
			return FALSE;
		}

		// Set the mode if not specified
		if ($mode === 'auto')
		{
			// Get the file extension so we can set the upload type
			$ext = $this->_getext($locpath);
			$mode = $this->_settype($ext);
		}

		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;

		$result = @ftp_put($this->conn_id, $rempath, $locpath, $mode);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_upload');
			}

			return FALSE;
		}

		// Set file permissions if needed
		if ($permissions !== NULL)
		{
			$this->chmod($rempath, (int) $permissions);
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Download a file from a remote server to the local server
	 *
	 * @param	string	$rempath
	 * @param	string	$locpath
	 * @param	string	$mode
	 * @return	bool
	 */
	public function download($rempath, $locpath, $mode = 'auto')
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Set the mode if not specified
		if ($mode === 'auto')
		{
			// Get the file extension so we can set the upload type
			$ext = $this->_getext($rempath);
			$mode = $this->_settype($ext);
		}

		$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
		
		$result = @ftp_get($this->conn_id, $locpath, $rempath, $mode);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_download');
			}

			return FALSE;
		}

		return TRUE;
	}

	public function download_folder($rempath, $locpath, $mode = 'auto')
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}
		// Set the mode if not specified
		if ($mode === 'auto')
		{
			// Get the file extension so we can set the upload type
			$ext = $this->_getext($rempath);
			$mode = $this->_settype($ext);
		}

		$downloadFileAr = $this->_tree_folder($rempath);

		if (sizeof($downloadFileAr) > 0) {
			$zip_file_name   = substr(strrchr($rempath, "/"), 1).date("_Y_m_d_H_i_s").".zip";
			$zip_file        = tempnam(sys_get_temp_dir(), $zip_file_name);
			$zip             = new ZipArchive();
			$zip->open($zip_file, ZipArchive::CREATE);

			foreach ($downloadFileAr as $file) {
				$file_local_path       = tempnam(sys_get_temp_dir(), $zip_file_name);

				$unlinkFileAr[] = $file_local_path;

				// $isError = 0;

				// ensureFtpConnActive();

				// Download file to client server
				$mode = ($mode === 'ascii') ? FTP_ASCII : FTP_BINARY;
				$result = @ftp_get($this->conn_id, $file_local_path, $file, $mode);

				$file_path = str_replace(pathinfo($rempath)['dirname']."/","",$file);
				//if ($isError == 0) {
				    $zip->addFile($file_local_path, $file_path);
				//}
			}
			$zip->close();

			foreach ($unlinkFileAr as $file) {
				unlink($file);
			} 

			header("Content-type: application/zip");
			header("Content-Disposition: attachment; filename=".$zip_file_name);
			header("Content-Length: " . filesize($zip_file));

			$fp = @fopen($zip_file, "r");
			while (!feof($fp)) {
				echo @fread($fp, filesize($zip_file));
				@flush();
			}
			@fclose($fp);

			unlink($zip_file);

		}
		/* elseif (sizeof($downloadFileAr) == 1) {
			$this->download($downloadFileAr[0], $locpath, "auto");
		}*/


		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_download');
			}

			return FALSE;
		}

		return TRUE;
	}
	function _tree_folder($path, &$downloadFileAr = array())
	{
		foreach (ftp_rawlist ($this->conn_id, $path) as $key => $row) {

			$out = preg_split("/[\s]+/", $row);

			$size = ftp_size($this->conn_id, $path.'/'.$out[8]);

			if ($size != -1) {
				$downloadFileAr[] = $path. "/" .$out[8];
			} else {
				$this->_tree_Folder($path. "/" . $out[8],$downloadFileAr);
			}
		}
		return $downloadFileAr;
	}
	function extract_zip($rempath)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}
		$zip = new ZipArchive;
		$res = $zip->open("ftp://".$this->username.":".$this->password."@".$this->hostname.$rempath);
		//ftp_fput($this->conn_id, $rempath, $fp, FTP_ASCII)
		var_dump($res === TRUE);
		if ($res === TRUE) {  
			$zip->extractTo("ftp://".$this->username.":".$this->password."@".$this->hostname);
			$zip->close();
			echo 'ok';
		} else {
			echo 'échec';
		}
	}
	// --------------------------------------------------------------------

	/**
	 * Rename (or move) a file
	 *
	 * @param	string	$old_file
	 * @param	string	$new_file
	 * @param	bool	$move
	 * @return	bool
	 */
	public function rename($old_file, $new_file, $move = FALSE)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_rename($this->conn_id, $old_file, $new_file);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_'.($move === FALSE ? 'rename' : 'move'));
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Move a file
	 *
	 * @param	string	$old_file
	 * @param	string	$new_file
	 * @return	bool
	 */
	public function move($old_file, $new_file)
	{
		return $this->rename($old_file, $new_file, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * Rename (or move) a file
	 *
	 * @param	string	$filepath
	 * @return	bool
	 */
	public function delete_file($filepath)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		$result = @ftp_delete($this->conn_id, $filepath);

		if ($result === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Delete a folder and recursively delete everything (including sub-folders)
	 * contained within it.
	 *
	 * @param	string	$filepath
	 * @return	bool
	 */
	public function delete_dir($filepath)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Add a trailing slash to the file path if needed
		$filepath = preg_replace('/(.+?)\/*$/', '\\1/', $filepath);

		$list = $this->list_files($filepath);
		if ( ! empty($list))
		{
			for ($i = 0, $c = count($list); $i < $c; $i++)
			{

				// If we can't delete the item it's probably a directory,
				// so we'll recursively call delete_dir()
				if ( ! preg_match('#/\.\.?$#', $list[$i]) && ! @ftp_delete($this->conn_id, $list[$i]))
				{
					$this->delete_dir($list[$i]);
				}
			}
		}

		if (@ftp_rmdir($this->conn_id, $filepath) === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_delete');
			}

			return FALSE;
		}

		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set file permissions
	 *
	 * @param	string	$path	File path
	 * @param	int	$perm	Permissions
	 * @return	bool
	 */
	public function chmod($path, $perm)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		if (@ftp_chmod($this->conn_id, $perm, $path) === FALSE)
		{
			if ($this->debug === TRUE)
			{
				$this->_error('ftp_unable_to_chmod');
			}

			return FALSE;
		}

		return TRUE;
	}
	// --------------------------------------------------------------------

	/**
	 * Set file permissions
	 *
	 * @param	string	$path	File path
	 * @return	text
	 */
	public function read_file($path)
	{
		if ( $this->_is_conn() )
		{
			$file = "ftp://".$this->username.":".$this->password."@".$this->hostname.$path;
			$content = file_get_contents($file);

			return $content;
		}

		return FALSE;
	}
	// ------------------------------------------------------------------------

	/**
	 * Write File
	 *
	 * Writes data to the file specified in the path.
	 * Creates a new file if non-existent.
	 *
	 * @param	string	$path	File path
	 * @param	string	$data	Data to write
	 * @param	string	$mode	fopen() mode (default: 'wb')
	 * @return	bool
	 */

	function write_file($path, $data, $mode = 'auto')
	{
		if ( $this->_is_conn() )
		{
			$file = "ftp://".$this->username.":".$this->password."@".$this->hostname.$path;

			/*$options = array('ftp' => array('overwrite' => true)); 
			$stream = stream_context_create($options);
			file_put_contents($file, "test", 0, $stream); */

			$fp = tmpfile();
			@fwrite($fp, $data);
			rewind($fp);
			ftp_fput($this->conn_id, $path, $fp, FTP_ASCII);
			@fclose($fp);
		}

		return FALSE;
	}
	// --------------------------------------------------------------------

	/**
	 * FTP List files in the specified directory
	 *
	 * @param	string	$path
	 * @return	array
	 */
	public function list_files($path = '.')
	{
		return $this->_is_conn()
			? ftp_nlist($this->conn_id, $path)
			: FALSE;
	}
	// --------------------------------------------------------------------

	/**
	 * FTP List files in the specified directory
	 *
	 * @param	string	$path
	 * @return	array
	 */
	public function list_files_details($path = '.')
	{
		if ( $this->_is_conn())
		{
			$i = 0;
			$list_files[$i] = array('title' => '..', 'type' => 'folder', 'icon' => 'icon-folder', 'chmod' => '', 'owner' =>'', 'size' => '', 'last_modified' => '');
			foreach (ftp_rawlist ($this->conn_id, $path) as $key => $row)
			{
				$out = preg_split("/[\s]+/", $row);
				
				/*$buff = ftp_mdtm($this->conn_id, ltrim($row,'/'));*/
				$size = ftp_size($this->conn_id, $path.'/'.$out[8]);

				if ($out[8] != ".." && $out[8] != ".") {
					if ($size != -1) {
						$list_files[++$i] = array('title' => $out[8], 'type' => 'file', 'icon' => $this->_file_icon_details($out[8]), 'chmod' => $out[0], 'owner' => $out[2], 'size' => byte_format($out[4]), 'last_modified' => $out[5]." ".$out[6] . " ".$out[7]);
					} else {
						$list_files[++$i] = array('title' => $out[8], 'type' => 'folder', 'icon' => 'icon-folder', 'chmod' => $out[0], 'owner' => $out[2], 'size' => '', 'last_modified' => $out[5]." ".$out[6] . " ".$out[7]);
					}
				}
			}
			return $list_files;
		} else {
			return FALSE;
		}
	}
	public function file_details($path = '.', $file)
	{
		if ( $this->_is_conn())
		{
			foreach (ftp_rawlist ($this->conn_id, $path) as $key => $row)
			{
				$out = preg_split("/[\s]+/", $row);
				
				$size = ftp_size($this->conn_id, $path.'/'.$out[8]);
				if ($out[8] == $file) {
					if ($size != -1) {
						return array('title' => $out[8], 'type' => 'file', 'icon' => $this->_file_icon_details($out[8]), 'chmod' => $out[0], 'owner' => $out[2], 'size' => $out[4], 'last_modified' => $out[5]." ".$out[6] . " ".$out[7]);
					} else {
						return array('title' => $out[8], 'type' => 'folder', 'icon' => 'icon-folder', 'chmod' => $out[0], 'owner' => $out[2], 'size' => '', 'last_modified' => $out[5]." ".$out[6] . " ".$out[7]);
					}
				}
			}
		} else {
			return FALSE;
		}
	}
	protected function _file_icon_details($title_file){
		$mime_file = get_mime_by_extension($title_file);

		switch ($mime_file) {
			case strpos($mime_file, 'excel') !== false:
			case strpos($mime_file, 'spreadsheetml') !== false:
				$file_icon = 'icon-file-excel';
				break;
			case strpos($mime_file, 'word') !== false:
			case strpos($mime_file, 'wordprocessingml') !== false:
				$file_icon = 'icon-file-word';
				break;
			case strpos($mime_file, 'powerpoint') !== false:
			case strpos($mime_file, 'presentationml') !== false:
				$file_icon = 'icon-file-powerpoint';
				break;		
			case strstr($mime_file, '/', true) == 'text':
				$file_icon = 'icon-file-document';
				break;
			case strstr($mime_file, '/', true) == 'image':
				$file_icon = 'icon-file-image';
				break;
			case strstr($mime_file, '/', true) == 'audio':
				$file_icon = 'icon-file-music';
				break;
			case strstr($mime_file, '/', true) == 'video':
				$file_icon = 'icon-file-video';
				break;
			case strpos($mime_file, 'zip') !== false:
			case strpos($mime_file, 'rar') !== false:
			case strpos($mime_file, 'tar') !== false:
			case strpos($mime_file, 'gzip') !== false:
			case strpos($mime_file, 'compressed') !== false:
				$file_icon = 'icon-zip-box';
				break;
			default:
				$file_icon = 'icon-file';
				break;
		}
		return $file_icon;
	}

	// ------------------------------------------------------------------------

	/**
	 * Read a directory and recreate it remotely
	 *
	 * This function recursively reads a folder and everything it contains
	 * (including sub-folders) and creates a mirror via FTP based on it.
	 * Whatever the directory structure of the original file path will be
	 * recreated on the server.
	 *
	 * @param	string	$locpath	Path to source with trailing slash
	 * @param	string	$rempath	Path to destination - include the base folder with trailing slash
	 * @return	bool
	 */
	public function mirror($locpath, $rempath)
	{
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}

		// Open the local file path
		if ($fp = @opendir($locpath))
		{
			// Attempt to open the remote file path and try to create it, if it doesn't exist
			if ( ! $this->changedir($rempath, TRUE) && ( ! $this->mkdir($rempath) OR ! $this->changedir($rempath)))
			{
				return FALSE;
			}

			// Recursively read the local directory
			while (FALSE !== ($file = readdir($fp)))
			{
				if (is_dir($locpath.$file) && $file[0] !== '.')
				{
					$this->mirror($locpath.$file.'/', $rempath.$file.'/');
				}
				elseif ($file[0] !== '.')
				{
					// Get the file extension so we can se the upload type
					$ext = $this->_getext($file);
					$mode = $this->_settype($ext);

					$this->upload($locpath.$file, $rempath.$file, $mode);
				}
			}

			return TRUE;
		}

		return FALSE;
	}

	// --------------------------------------------------------------------

	/**
	 * Extract the file extension
	 *
	 * @param	string	$filename
	 * @return	string
	 */
	protected function _getext($filename)
	{
		return (($dot = strrpos($filename, '.')) === FALSE)
			? 'txt'
			: substr($filename, $dot + 1);
	}

	// --------------------------------------------------------------------

	/**
	 * Set the upload type
	 *
	 * @param	string	$ext	Filename extension
	 * @return	string
	 */
	protected function _settype($ext)
	{
		return in_array($ext, array('txt', 'text', 'php', 'phps', 'php4', 'js', 'css', 'htm', 'html', 'phtml', 'shtml', 'log', 'xml'), TRUE)
			? 'ascii'
			: 'binary';
	}

	// ------------------------------------------------------------------------

	/**
	 * Close the connection
	 *
	 * @return	bool
	 */
	public function close()
	{
		return $this->_is_conn()
			? @ftp_close($this->conn_id)
			: FALSE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Display error message
	 *
	 * @param	string	$line
	 * @return	void
	 */
	protected function _error($line)
	{
		$CI =& get_instance();
		$CI->lang->load('ftp');
		show_error($CI->lang->line($line));
	}

}
