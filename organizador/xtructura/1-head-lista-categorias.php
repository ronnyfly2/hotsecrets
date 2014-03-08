<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Mosaddek">
<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<link rel="shortcut icon" href="img/favicon.png">
<title>Lista de Categorias</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<!--external css-->
<link href="css/font-awesome.css" rel="stylesheet" />
<link href="css/demo_page.css" rel="stylesheet" />
<link href="css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="css/DT_bootstrap.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet" />
<style type="text/css" title="currentStyle">
@import "css/TableTools.css";
</style>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" charset="utf-8" src="js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="js/TableTools.js"></script>        

<script type="text/javascript" charset="utf-8">
$(document).ready( function () {
$('#tabla-color').dataTable( {
"sDom": 'T<"clear">lfrtip',
"oTableTools": {
"aButtons": [
//"copy",
//"csv",
"xls",
{
"sExtends": "pdf",
"sPdfMessage": "Your custom message would go here."
},
//"print"
]
}
} );
} );
</script>
</head>