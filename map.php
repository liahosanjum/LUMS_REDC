<html>
<head>
<!--<title>First Presentation</title>-->
<link rel="stylesheet" type="text/css" href="css/presentation.css" />
<script language="javascript" type="text/javascript">
var nW,nH,oH,oW;
function zoom(iWideSmall,iHighSmall,iWideLarge,iHighLarge,whichImage)
{
	oW=whichImage.style.width;oH=whichImage.style.height;
	if((oW==iWideLarge)||(oH==iHighLarge))
	{
		nW=iWideSmall;nH=iHighSmall;
	}
	else
	{
		nW=iWideLarge;nH=iHighLarge;
	}
	whichImage.style.width=nW;whichImage.style.height=nH;
}
</script>
<style type="text/css">
body {
	margin: 0;
	background: #fff;
	
}

#presentation-1 {
	/* border: 1px solid #ccc; */
	height: 100%;
	width: 100%;
}

#presentation-2 {
	/* border: 1px solid #ccc; */
	top: 50%;
	width: 100%;
	height: 50%;
}

.header {
	position: fixed;
	width: 100%;
	top: 0%;
	height: 12%; 
	background: #ccf;
}

body .header h1 {
	/* border: 1px solid #ccc; */
	margin: 0px;
	padding: 12px 2px 0px 26px;
	font-size: 42px;
	margin-left: 30px;
	/***
	background: blue;
	height: 12%; 
	***/
}

.slide h3, .slide h4 {
	padding: 0px 2px 0px 60px;
	margin: 0px;
}

.slide h3 {
	margin-top: 100px;
}

.slide h1 {
	padding: 80px 2px 0px 60px;
	font-size: 45px;
}

.slide {
	/* background: red;*/
	position: fixed;
	top: 12%;
	overflow:scroll;
	height: 81%; 
	width: 100%; /** added **/
}

.slide ul  {
	font-size: 30px;
	color: #000;
	margin-top: 8px;
}


.content > ul {
	margin-top: 30px;
	margin-left: 30px;
}

.content pre {
	font-size: 25px;
	margin-top: 30px;
	margin-left: 50px;
}

.content ul {
	margin-bottom: 15px;
}

.footer {
	/* border: 1px solid #ccc;*/
	position: fixed;
	top: 90%;
	background: #ccf;
	height: 10%;
	width: 100%;
}

.title {
	position: absolute;
	/** background: #CCC; **/
	text-align: left;
	width: 45%;
	height: 100%;
	padding: 28px 0px 2px 4px;
}

.footer .pagenumber {
	position: absolute;
	/* top: 0%; */
	left: 45%;
	width: 10%;
	/** background: #CCC; **/
	text-align: center;
	height: 100%;
	padding: 28px 0px 2px 0px;
}

.footer .info {
	position: absolute;
	/* top: 0%; */
	width: 45%;
	left: 55%;
	height: 100%;
	/** background: #CCC; **/
	text-align: right;
	padding: 28px 0px 2px 0px;
}

</style>
<script src="js/jquery-1.3.2.js" type="text/javascript"></script>
</head>

<body>
<div id="presentation-1">
	  <img border="0" src="images/map.jpg" width="100%" height="100%" onclick="zoom('100%','100%','150%','150%',this);"/>

</div> <!-- div presentation-1 end -->

</body>

</html>
