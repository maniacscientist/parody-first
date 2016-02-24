function doAction(action, target_id, form_id, callback)
{
	var formData = $("#"+form_id).serialize();

	$.ajax(
		{
			url: "libs/superlib/superlibDispatcher.php?a="+action,
			data: formData,
			success: function(result)
			{
				var obj = JSON.parse(result);

				if(target_id!=null)
				{
					var target_el = document.getElementById(target_id);
					target_el.innerHTML = obj.html;
				}
				else
				{
					document.write(obj.html);
				}

				callback(obj.code);
			}
		}
	);
}