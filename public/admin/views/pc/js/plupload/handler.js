	var uploadObj;

    function uploadAddFiles(up, files){
	uploadObj = up;
    	plupload.each(files, function(file) {
			document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
		});
    }

    function removeFile(filename, id){
    	uploadObj.removeFile(filename);
	
    }

    function uploadProgress(up, file) {
	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
	}

	function uploadSuccess(up, file, serverData) {//alert(serverData.response);
		var imgObj = $.parseJSON(serverData.response);

		if (imgObj.flag == 1)
		{
			var newElement = "<img src='" + imgObj.thumb + "' >";
			newElement += "<input type='hidden' name='imgData[]' value=' " + imgObj.img + "' />";
			$("#imgContainer").append(newElement);
			//双击图片删除
			$('#imgContainer').find('img').on('dblclick',function(){
				$(this).next('input').remove();
				$(this).remove();
			})
		}else{
			var newElement = "<span>" +file.name+ "上传失败：失败信息: " + imgObj.error + "</span>";
		}
		
	}

	function uploadError(up, err){
		document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
	}


	$(function(){
		$('#imgContainer').find('img').on('dblclick',function(){
			$(this).next('input').remove();
			$(this).remove();
		})
	})