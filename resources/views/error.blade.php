<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>系统错误 - BranchZero no CMS</title>
	<meta name="Robots" content="NOINDEX, NOFOLLOW, NOARCHIVE"/>
	<meta name="ViewPort" content="initial-scale=1, minimum-scale=1, width=device-width"/>
	<style type="text/css">
		::selection { background: rgba(78, 176, 248, 0.3); }
		html, body { width: 100%; height: 100%; cursor: default; }
		html, body, p, h2, div { margin: 0; padding: 0; }
		body { background: #2980B9; text-align: center; user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; }
    html { font: 12px "Segoe UI", "Microsoft YaHei", FreeSans, Arimo, "Droid Sans", "Hiragino Sans GB", "Hiragino Sans GB W3", Arial, sans-serif; }
		h2 { margin-bottom: 25px; font-size: 30px; font-weight: 300; color: #e05d6f; }
		p { line-height: 1.5em; font-size: 12px; color: #95a2a9; margin-bottom: 5px; }
		.title { position: relative; top: 75px; margin-bottom: .7em; line-height: 30px; font-size: 26px; font-weight: 300; color: #fff; text-shadow: 0 0 4px #666666; }
		.box { position: relative; top: 80px; width: 600px; max-width: 85%; margin: 0 auto; background: #fff; padding: 15px; box-shadow: 0 0 50px #2964B9; }
		.main { font-size: 18px; color: #000; font-weight: 500; line-height: 1.7em; margin: 0 0 10px; }
		.foot { position: relative; top: 80px; margin: 15px 15px 0; font-size: 12px; color:#4eb0f8; }
		pre { background: #3498DB; color: #ffffff; padding: 15px 20px; margin: 25px -15px -15px; line-height: 1.4em; font-size: 14px; text-align: left; word-break: break-all; white-space: pre-wrap; }
                                .main, pre { user-select: text; -webkit-user-select: text; -moz-user-select: text; -ms-user-select: text; cursor: text; }
		pre::selection { background: rgba(255, 255, 255, 0.99); color: #3498DB; }
                                    </style>
</head>
<body>
<p class="title">BranchZero no CMS</p>
<div class="box">
	<h2><b>系统错误</b></h2>
	<p class="main selectable"><?php echo $e->getMessage();?></p>
	<p>对您造成的困扰，我们深感抱歉！</p>
	<pre><b>跟踪：</b><br><?php echo htmlentities($e->getTraceAsString());?></pre>
</div>
<p class="foot">Framed By Laravel && Developed By BranchZero Sun</p>
</body>
</html>