$(function () {
  $(".selectBtn").on("click", function (event) {
    var name1 = $(this).closest('tr').find('input').val();
    // var name2 = $(this).closest('tr').find('input[name=name]').val();
    // var name3 = $(this).closest('tr').children("td").children('input').val();

    let id = $("#main").val();
    $.ajax({
      type: "POST",
      url: "json.php",
      data: { "id": name1 },
      dataType: "json"
    }).done(function (data) {
    }).fail(function (XMLHttpRequest, status, e) {
      alert(e);
    });
    location.reload();

  });

});

$(function () {
  $(".deleteBtn").on("click", function (event) {
    let delete_cpmnfirm = confirm('削除しますか');

    if (delete_cpmnfirm) {
      var name1 = $(this).closest('tr').find('input').val();
      // var name2 = $(this).closest('tr').find('input[name=name]').val();
      // var name3 = $(this).closest('tr').children("td").children('input').val();
      let id = $("#main").val();
      $.ajax({
        type: "POST",
        url: "json.php",
        data: { "delete": name1 },
        dataType: "json"
      }).done(function (data) {
        // $("#return").append('<p>'+data.id);
        console.log('削除しました');
      }).fail(function (XMLHttpRequest, status, e) {
        alert(e);
      });

      location.reload();
    } else {
      console.log('削除をとりやめました');
    }
  });
});



$(function(){
	$('#button').bind("click",function(){
    console.log("A");
		var re = new RegExp($('#search').val());
		$('#result tbody tr').each(function(){
			var txt = $(this).find("td:eq(0)").html();
			if(txt.match(re) != null){
				$(this).show();
			}else{
				$(this).hide();
			}
		});
	});

	$('#button2').bind("click",function(){
		$('#search').val('');
		$('#result tr').show();
	});
});

$(function(){
	$('#time-search').bind("click",function(){
    var time = document.getElementById("time");
    console.log(time);
	});
});




