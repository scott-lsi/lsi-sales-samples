<!doctype html>
<html lang="en">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $product->name }} Personaliser | {{ env('APP_TITLE') }}</title>

        @include('partials.stylesheets')
		
		<style>
			body, html {
				padding: 0; margin: 0; width: 100%; height: 100%;
			}
			
			#personaliser, iframe {
				width: 100%; height: 100%; border: 0;
			}
		</style>

        @include('partials.headerscripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	</head>
	
	<body>
        @if(session('message'))
            <div
                class="fixed w-full h-full bg-gray-900 bg-opacity-60 cursor-pointer text-center flex justify-center items-center content-center"
                x-data="{ shown: true }"
                x-show="shown"
                @click="shown = false"
                >
                    <div class="bg-red-600 rounded text-white p-4 w-1/2 lg:w-1/3">
                        <p class="mb-4">{{ session('message') }}</p>
                        <p>Click to hide this message</p>
                    </div>
            </div>
        @endif

		<div id="personaliser">
			<iframe src="" id="personaliser-iframe"></iframe>
		</div>

        <script>
            $(document).ready(function(){
                let iframeOrigin = '<?php echo $product->personaliser($ref)['iframeOrigin']; ?>';
                let iframeUrl = '<?php echo $product->personaliser($ref)['iframeUrl']; ?>';

                let meo = location.origin;
                let mei = Math.random().toString(16).substr(2);

                window.addEventListener("message", e => {
                    if(e.origin == iframeOrigin && e.data.id == mei){
                        switch(e.data.name){
                            case 'ADD_TO_CART_CALLBACK':
                                // handle the callback
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                var jqxhr = $.post('{{ route('basket.add', [$product, $rowId]) }}', { data: e.data.body.items[0] });
                                jqxhr.done(function(){
                                    window.parent.location.href = jqxhr.responseText;
                                });
                                break;
                        }
                    }
                });

                let iframe = document.getElementById('personaliser-iframe');
                iframe.src = iframeUrl + "&meo=" + meo + "&mei=" + mei;
            });
        </script>
	</body>
</html>