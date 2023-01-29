            function read_cookie(key)
            {
                var result;
                return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? (result[1]) : null;
            }
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                var dark = "dark";
            } else { var dark = "light"; }
            if(dark != read_cookie('theme')){
                //window.location.replace(window.location.href);
                location.reload(true);
            } 
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.cookie = "theme=dark; expires=2100; path=/";
            } else{
                document.cookie = "theme=light; expires=2100; path=/";
            }
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                location.reload(true);
            });
 
