<head>

</head>
<body>

</body>
    <script>
        /* animated loading with "..." moving on center in canvas */
        var canvas = document.createElement('canvas');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        document.body.appendChild(canvas);
        var ctx = canvas.getContext('2d');
        var dots = ['.', '..', '...'];
        var dotIndex = 0;
        var dotInterval = setInterval(function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.font = '100px sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(dots[dotIndex], canvas.width / 2, canvas.height / 2);
            dotIndex = (dotIndex + 1) % dots.length;
        }, 500);
    </script>
