function ChangeGIF() {
	var gif;
	gif = eval("TITLE");
	if( gif.src == "photosource/Donor_List.GIF"){
		alert("1");
	gif.src = "photosource/Student_List.GIF";
	}else{
		alert("2");
		gif.src = "photosource/Donor_List.GIF";
	}
}
