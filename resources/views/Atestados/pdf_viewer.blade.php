<!-- resources/views/atestados/pdf_viewer.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Visualizar Atestado</title>

    <!-- PDF.js CSS from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf_viewer.min.css">

    <!-- Your custom styles if any -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
</head>

<body>

    <!-- Page wrapper starts -->
    <div class="page-wrapper">

        <!-- App header starts -->
        @include('partials.header')
        <!-- App header ends -->

        <!-- Main container starts -->
        <div class="main-container">

            <!-- Sidebar wrapper starts -->
            @include('partials.sidebar')
            <!-- Sidebar wrapper ends -->

            <!-- App container starts -->
            <div class="app-container">

                <!-- App hero header starts -->
                <div class="app-hero-header d-flex align-items-center">
                    <!-- Breadcrumb starts -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Visualizar Atestado
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <div class="d-flex justify-content-end mb-3">
                        <button id="print-button" class="btn btn-primary">Print</button>
                    </div>
                    <div id="pdf-viewer" class="pdfViewer">
                        <canvas id="pdf-canvas" style="border: 1px solid black; width: 100%;"></canvas>
                    </div>
                    <iframe id="pdf-iframe" style="display: none;"></iframe>
                </div>
                <!-- App body ends -->

                <!-- App footer starts -->
                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
                <!-- App footer ends -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Main container ends -->

    </div>
    <!-- Page wrapper ends -->

    <!-- PDF.js Scripts from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf_viewer.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pdfData = atob("{{ $pdfContent }}");
            var loadingTask = pdfjsLib.getDocument({data: pdfData});
            var pdfDoc = null;
            var pageNum = 1;
            var scale = 1.5;
            var canvas = document.getElementById('pdf-canvas');
            var ctx = canvas.getContext('2d');

            function renderPage(num) {
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport({scale: scale});
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    var renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(function() {
                        console.log('Page rendered');
                    });
                });
            }

            loadingTask.promise.then(function(pdf) {
                pdfDoc = pdf;
                console.log('PDF loaded');
                renderPage(pageNum);
            }, function(reason) {
                console.error(reason);
            });

            document.getElementById('print-button').addEventListener('click', function() {
                var pdfDataUrl = 'data:application/pdf;base64,' + "{{ base64_encode($pdfContent) }}";
                var iframe = document.getElementById('pdf-iframe');
                iframe.src = pdfDataUrl;
                iframe.style.display = 'block';

                iframe.onload = function() {
                    iframe.contentWindow.print();
                };
            });
        });
    </script>
</body>

</html>
