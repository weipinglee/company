<?php

namespace Library;
use \Library\url;

class plupload{

	private $_uploadJsPaht;

	/**
	 * 上传文件的大小
	 * @var
	 */
	private $_fileSize = '2mb';

	/**
	 * 上传文件的类型
	 * @var array
	 */
	private $_fileType = array(
		'img' => '{title : "Image files", extensions : "jpg,gif,png"}', 
		'zip' => '{title : "Zip files", extensions : "zip"}'
	);

	private $_uploadUrl;

	/**
	 * 当前支持的上传类型
	 * @var string
	 */
	private $_nowUploadType = '';

	public function __construct($uploadUrl, $size = '2mb', $types = array('img')){
		$this->_uploadJsPaht = url::getBaseUrl() . '/admin/views/pc/js/plupload/';
		$this->_uploadUrl = $uploadUrl;
		// 设置文件大小
		$this->_fileSize = $size;
		// 设置上传的类型
		foreach ($types as $type) {
			$this->_nowUploadType .= $this->_fileType[$type];
		}
	}

	public function show(){
		return <<< EOF
		<script type="text/javascript" src="{$this->_uploadJsPaht}/plupload.full.min.js"></script>
		<script type="text/javascript" src="{$this->_uploadJsPaht}/handler.js"></script>
		<script type="text/javascript">
		var uploader = new plupload.Uploader({
			runtimes : 'html5,flash,silverlight,html4',
			browse_button : 'pickfiles', // you can pass an id...
			container: document.getElementById('imgContainer'), // ... or DOM Element itself
			url : "{$this->_uploadUrl}",
			flash_swf_url : '{$this->_uploadJsPaht}/Moxie.swf',
			silverlight_xap_url : '{$this->_uploadJsPaht}/js/Moxie.xap',
			
			filters : {
				max_file_size : "{$this->_fileSize}",
				mime_types: [
					{$this->_nowUploadType}
				]
			},

			init: {
				PostInit: function() {
					document.getElementById('uploadfiles').onclick = function() {
						uploader.start();
						return false;
					};
				},

				FilesAdded: function(up, files) {
					uploadAddFiles(up, files);
				},

				UploadProgress: function(up, file) {
					uploadProgress(up, file);
				},

				FileUploaded(up, file, serverData){
					uploadSuccess(up, file, serverData);
				},

				Error: function(up, err) {
					uploadError(up, err);
				}
			}
		});

		uploader.init();

		</script>
EOF;
	}

}