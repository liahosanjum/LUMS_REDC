// JavaScript Document
function search(e, obj)
{
	if (e.which == null || e.which == undefined) { // ie
		keycode = event.keyCode;
	} else { // mozilla
		keycode = e.which;
	}

	if(obj.value != "" && keycode == 13)
	{
		location.href = 'search.php?search=' + obj.value;
	}
}