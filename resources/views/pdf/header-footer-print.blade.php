<!DOCTYPE html>
<html>
<head>
	<title>Header/Footer Print</title>
</head>
<body>
	<table>
	  <thead><tr><td>
	    <div class="header-space">&nbsp;</div>
	  </td></tr></thead>
	  <tbody><tr><td>
	    <div class="content">...</div>
	  </td></tr></tbody>
	  <tfoot><tr><td>
	    <div class="footer-space">&nbsp;</div>
	  </td></tr></tfoot>
	</table>
	<div class="header">...</div>
	<div class="footer">...</div>
	<style type="text/css">
		.header, .header-space,
		.footer, .footer-space {
		  height: 100px;
		  background-color: yellow;
		}
		.header {
		  position: fixed;
		  top: 0;
		}
		.footer {
		  position: fixed;
		  bottom: 0;
		}
	</style>
</body>
<script>
	$(document).ready(function(){
	  window.print();
	});
</script>
</html>