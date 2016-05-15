function open_popup(url){
    var w = 1000;
    var h =	500;
    var l = Math.floor((screen.width-w)/2);
    var t = Math.floor((screen.height-h)/2);
    var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}
function checkMenu() {
	if(document.Menufrm.danhMuc.value == "") {
		$('#danhMuc').notify("Tên danh mục rỗng");
		return false;
	}
	return true;
}
function checkBaiViet() {
	if(document.BVietfrm.baiViet.value == "") {
		$('#baiViet').notify("Chủ đề rỗng");
		return false;
	}
	if(document.BVietfrm.danhMuc.value == "") {
		$('#danhMuc').notify("Chưa chọn danh mục");
		return false;
	}
	if(tinyMCE.get('noiDung').getContent() == "") {
		$('#noiDung').notify("Nội dung rỗng");
		return false;
	}
	return true;
}
function thayDoi(){
	if(document.DMKfrm.mkc.value == "") {
		$('#mkc').notify("Mật khẩu hiện tại rỗng");
		return false;
	}
	if(document.DMKfrm.mkm.value == "") {
		$('#mkm').notify("Mật khẩu mới rỗng");
		return false;
	}
	if(document.DMKfrm.xnmk.value == "") {
		$('#xnmk').notify("Xác nhận mật khẩu rỗng");
		return false;
	}
	if(document.DMKfrm.xnmk.value != document.DMKfrm.mkm.value) {
		$('#xnmk').notify("Vui lòng nhập đúng như trên");
		return false;
	}
	return true;	
}
function NotifySuccess(msg) {
	$.notify(msg, 'success');
}
function NotifyError(msg) {
	$.notify(msg, 'error');
}
function Location(url) {
	setTimeout(function() {
		window.location = url;
	}, 2000);
}