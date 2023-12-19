<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="author" content="Peter Manoukian">
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:8000/api');
header('Access-Control-Allow-Origin: http://127.0.0.1:8000/api/');
header("Access-Control-Allow-Origin: http://127.0.0.1"); 
header("Access-Control-Allow-Origin: http://127.0.0.1:8000"); 

?>






    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="img/favicon-32x32.png" type="image/x-icon" />

	<?php
	if(isset($row) && $row != "")
	{
	?>
	
		<title>{!! str_replace('-', ' ', $row->title) !!}</title>
		@if($row->metades != "")
		<meta name = 'description' content = '{{ $row->metades }}'>
		@else
		<meta name = 'description' content = '{{ $row->des }}'>
		@endif
		@if($row->keywordd != "")
			<meta name =  'keywords' content  = '{{ $row->keywordd }}'>
		@else
		<meta name =  'keywords' content = 'politics,armenia,armenian politics,politcal articles,lebanese politics,blog,lebanon,international news, lebanese armenian blogger'>
		@endif
		
		<meta property="og:image" content="https://www.socialist-armenia.org/images/news/{{$row->img}}" />
		<meta property="og:image:width" content="450"/>
		<meta property="og:image:height" content="298"/>
		
		
		<meta property="og:title" content="{{ $row->name  }}"/>
		<meta property="og:url" content="{{  Request::url() }}">
		<meta property="og:description" content="{{Str::limit($row->des, 190)}}"/>
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="National Patriotic Democratic Socialism Armenian Lebanon">
		<meta property="og:image:type" content="image/jpeg" />	
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="{{ $row->name  }}">
		<meta name="twitter:description" content="{{Str::limit($row->des, 190)}}">
		<meta name="twitter:image" content="https://www.socialist-armenia.org/images/news/{{$row->img}}">
		<meta name="twitter:image:width" content="450">
		<meta name="twitter:image:height" content="298">
		
		
		
		
	
	<?php
	}
	else
	{
	?>
   <title>Nationalist Armenia Armenian national democratic socialists</title>
   <meta name = 'description' content = 'Lebanese Armenian Blogger , blog about Lebanese, Armenian international events, political social articles, Armenia, Lebanon'>
   <meta name =  'keywords' content  = 'Armenian Nationalism, National Socialists Armenia, patriotic democratic socialists,politics,armenia,armenian politics,politcal articles,lebanese politics,blog,lebanon,international news, lebanese armenian blogger'>

	<meta property="og:image" content="https://www.socialist-armenia.org/images/ban/Garegin-Njteh-Armenian-Nationalism-symbol-Nationalist-Armenia-167.jpg" />
	<meta property="og:image:width" content="450"/>
	<meta property="og:image:height" content="298"/>
	
	
	<meta property="og:title" content="Nationalist Armenia Armenian national democratic socialists"/>
	<meta property="og:url" content="{{  Request::url() }}">
	<meta property="og:description" content="Armenian National Democratic Patriotic Socialism, Armenian Blog and articles, Social ecnomocial political isues discussion in Lebanon and Armenia"/>
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="National Patriotic Democratic Socialism Armenian Lebanon">
	<meta property="og:image:type" content="image/jpeg" />	
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Nationalist Armenia Armenian national democratic socialists">
	<meta name="twitter:description" content="Armenian National Democratic Patriotic Socialism, Armenian Blog and articles, Social ecnomocial political isues discussion in Lebanon and Armenia">
	<meta name="twitter:image" content="https://www.socialist-armenia.org/images/ban/Garegin-Njteh-Armenian-Nationalism-symbol-Nationalist-Armenia-167.jpg">
	<meta name="twitter:image:width" content="450">
	<meta name="twitter:image:height" content="298">
	
	<?php
	}
	
	?>
	
	
	
  <link rel="stylesheet" href="{{ asset('css2/bootstrap.min.css') }} ">
  
   <link href="{{ asset('css2/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css2/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/css.css') }}" rel="stylesheet">
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body  class="bg-shape">

  <div id="fb-root"></div>
 

<div id="app2">
 <main-Home />
</div>
<script src="{{ asset('js/app2.js') }}"></script>
<script src="{{ asset('js2/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js2/popper.min.js') }}"></script>
<script src="{{ asset('js2/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/animate-css/wow.min.js') }}"></script>
<script src="{{ asset('js2/theme.js') }}"></script>



<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
 <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk')); 
$(document).ready(function () 
{  
	$('.page-link').click(function()
	{
		alert(1);
	
	});
	$('.page-item').click(function()
	{
		alert(2);
	
	});
});	
</script>
</body>
</html>