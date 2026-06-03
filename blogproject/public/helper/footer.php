</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        function loadFile(event){
            let output = document.getElementById('output');

            var reader = new FileReader();//use the filereader function to read the file builtin function
            reader.onload = function(){
                output.src = reader.result; // taking the result in the img src from the reading file.
            }
            reader.readAsDataURL(event.target.files[0]);//showing the reult output such as photo with this funtion. builtin function
        }
    </script>    
</html>
