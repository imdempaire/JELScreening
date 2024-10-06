<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style type="text/css">
    No_imprimir {
        display: block;
    }

    @media print { /* Sets print view with media query */
        body * {
            display: none;
        }

        /* Sets body and elements in it to not display */
        .print-area, .print-area * {
            display: block;
        }

        /* Sets print area element and all its content to display */
    }
</style>

<body>
    Don't print me 0.
    Don't print me 0.
    <No_imprimir>
        Don't print me 1.
    </No_imprimir>
    
    <div class="print-area">
        Print me.
        <No_imprimir>
            Don't print me 2.
        </No_imprimir>
    </div>
    
    <No_imprimir>
        Don't print me 3.
    </No_imprimir>

    <button id="printBtn">Print</button>
</body>

<script type="text/javascript">
    document.getElementById('printBtn').addEventListener('click', () => { window.print() }); // Prints area to which class was assigned only
</script>
  
</body>
</html>