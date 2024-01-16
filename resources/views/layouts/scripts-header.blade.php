{{-- shadowbox --}}
<link rel="stylesheet" type="text/css" href="{{ asset('shadowbox/shadowbox.css') }}" />
<script type="text/javascript" src="{{ asset('shadowbox/shadowbox.js') }}"></script>
<script type="text/javascript">
    Shadowbox.init({
        language: 'pt-BR',
        players: ['img', 'html', 'iframe']
    });
</script>

{{-- modo dark --}}
<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>