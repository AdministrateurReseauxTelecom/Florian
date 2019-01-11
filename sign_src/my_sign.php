<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <title>Signature(Test)</title>
        <link href="./css/jquery.signaturepad.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="./js/numeric-1.2.6.min.js"></script> 
        <script src="./js/bezier.js"></script>
        <script src="./js/jquery.signaturepad.js"></script> 

        <script type='text/javascript' src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
        <script src="./js/json2.min.js"></script>


        <style type="text/css">
                                
            body{
                font-family:monospace;
                text-align:center;
            }
            #btnSaveSign {
                color: #fff;
                background: #f99a0b;
                padding: 5px;
                border: none;
                border-radius: 5px;
                font-size: 20px;
                margin-top: 10px;
            }
            #signArea{
                width:100% ;
                
            }
            .sign-container {
                width: 100%;
                margin: auto;
            }
            .sign-preview {
                width: 150px;
                height: 50px;
                border: solid 1px #CFCFCF;
                margin: 10px 5px;
            }
            .tag-ingo {
                font-family: cursive;
                font-size: 12px;
                text-align: left;
                font-style: oblique;
            }
        </style>
    </head>
    <body>


        <div id="signArea" >
            <h2 class="tag-ingo">Signer ci-dessous</h2>
            <div class="sig sigWrapper" style="height:auto;">
                <div class="typed"></div>
                <canvas id="mainCanvas">
		</canvas>     
            </div>
        </div>      
        <style>
  
</style>
<script>
			(function () {
				
        canvas = document.getElementById('mainCanvas');
				ctx = canvas.getContext("2d");
				
				canvas.width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
				canvas.height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				WIDTH	= canvas.width;
				HEIGHT	= canvas.height;
				
				clearScreen();
			})();
			
			function resizeCanvas() {
				canvas.width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
				canvas.height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				
				WIDTH = canvas.width;
				HEIGHT = canvas.height;
				
				clearScreen();
			}
			
			function clearScreen() {
				var grd = ctx.createLinearGradient(0,0,0,180);
				grd.addColorStop(0,"#6666ff");
				grd.addColorStop(1,"#aaaacc");

				ctx.fillStyle = grd;
				ctx.fillRect(0,0, WIDTH, HEIGHT );                               
			}
                        function launchFullScreen(element) {
  if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
}

// Launch fullscreen for browsers that support it!
launchFullScreen(document.documentElement); // the whole page
launchFullScreen(document.getElementById('mainCanvas'));
		</script>
   
        
        <button id="btnSaveSign">Sauvegarder</button>


        <script>
            $(document).ready(function () {
                $('#signArea').signaturePad({drawOnly: true, drawBezierCurves: true, lineTop: -1});
            });

            $("#btnSaveSign").click(function (e) {
                html2canvas([document.getElementById('sign-pad')], {
                    onrendered: function (canvas) {
                        var canvas_img_data = canvas.toDataURL('image/png');
                        var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                        //ajax call to save image inside folder
                        $.ajax({
                            url: 'save_sign.php',
                            data: {img_data: img_data},
                            type: 'post',
                            dataType: 'json',
                            success: function (response) {
                                window.location.reload();
                            }
                        });
                    }
                });
            });
        </script> 
 


    </body>
</html>
