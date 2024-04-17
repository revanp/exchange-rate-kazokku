

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Exchange Rate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link href="{{ asset('public/assets/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('public/assets/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
</head>
<body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

    @include('layouts.header-mobile')
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.aside')
        </div>

        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layouts.header')

            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                @yield('content')
            </div>
        </div>
	</div>

    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>

    <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.bundle.js?v=7.0.6') }}"></script>

    <script>
        $('form').submit(function(e){
            e.preventDefault();

            var action = $(this).attr('action');

            var button = $(this).find('button[type="submit"]');

            button.attr('disabled', true);

            var formData = new FormData(this);

            $.ajax({
                url: action,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data){
                    if(data.redirect != null){
                        window.location.replace(data.redirect);
                    }
                },
                error: function(data){
                    var result = data.responseJSON;

                    if(result.code == 422){
                        $.each(result.data, function(key, value){
                            toastr.error(value[0]);
                        })
                    }else{
                        toastr.error(result.message);
                    }

                    button.attr('disabled', false);
                }
            })
        });
    </script>
</body>
</html>
