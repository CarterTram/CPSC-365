$(document).ready(function()
{
	$('#addActorButton').click (function ()
	
	{
        $('<input type="text" name ="actor[]"><br/>').insertAfter('#actorList:last');
	});

	
});	