<!-- Simple page to show information about a resource, and then provide the option
to download it -->

<h1>File download</h1>
<h3>Filename</h3>
<hr />
<h2>File information</h2>
<p>Some stuff about the file.</p>
<br />
<button id="download">Begin download</button>
<p style="opacity:0.0;" id="confirm">Your download has begun</p>

<script type="text/javascript">
$("#download").click(function(){
    var downloadURL = "";
	window.open(downloadURL,'_blank');
	$(this).css({'opacity':'0.0'});
	$("#confirm").css({'opacity':'1.0'});
});
$("title").html("Will W download");
</script>