<?php 
	include("header.php");
?>

<script>
	$(function(){
		$("#pcode").keypress(function(event) {
			if (event.which == 13) { // Check if the Enter key is pressed
				event.preventDefault(); // Prevent default form submission
				var code = $("#pcode").val();
				$.post('pro_oder.php',{txtcode:code},function(data){
					if(data == "" || data == 0){
						alert("No Product found");
					}else{
						var arr = data.split(";");
						var qty = parseInt(arr[2]);
						var price = parseFloat(arr[3]);
						var amount = qty * price;
						
						$("#orderbody").append("<tr><td>"+arr[0]+"</td><td>"+arr[1]+"</td><td><input type='text' value='"+arr[2]+"'></td><td>"+price+"</td><td>"+amount+"</td></tr>");
						
						updateTotal();
					}
				});
			}
		});

		function updateTotal() {
			var totalQty = 0;
			var totalAmount = 0;
			$("#orderbody tr").each(function() {
				var qty = parseInt($(this).find("input").val());
				var price = parseFloat($(this).find("td:eq(3)").text().replace("$", ""));
				var amount = qty * price;
				totalQty += qty;
				totalAmount += amount;
			});
			$("td[colspan='4']").next("td").text("$" + totalAmount.toFixed(2));
		}
	});
</script>

<form>
	Product Code: <input type="text" id="pcode">
</form>

Sale List
<table class="table table-bordered">
	<thead>
		<tr>
			<td>Product ID</td>
			<td>Product Name</td>
			<td>Qty</td>
			<td>Price</td>
			<td>Amount</td>
		</tr>
	</thead>
	<tbody id="orderbody">
		
	</tbody>

	<thead>
		<tr>
			<td colspan="4" align="right">Total</td>
			<td></td>
		</tr>
	</thead>
</table>
<?php 
	include("footer.php");
?>
