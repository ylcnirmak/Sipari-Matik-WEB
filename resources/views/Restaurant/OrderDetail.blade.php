@extends('Restaurant.Bilesenler.app')
@section('content')
<h5>Sipariş Detay</h5>
<script>
    const masaId = {{ $masaId }};
    
    function unlockTable() {
        const formData = new FormData();
        formData.append('masaId', masaId);
        formData.append('_token', '{{ csrf_token() }}');
        
        navigator.sendBeacon('{{ route("unlockTable") }}', formData);
    }
    
    // Sayfa kapanırken masa kilidini aç
    window.addEventListener('beforeunload', unlockTable);
    
    // Tarayıcı geri butonuna basıldığında
    window.addEventListener('popstate', function() {
        fetch('{{ route("unlockTable") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({masaId: masaId})
        });
    });
    
    // Sayfa yeniden yüklendiğinde
    window.addEventListener('pagehide', unlockTable);
    
    // Visibility API - sayfa gizlendiğinde
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'hidden') {
            unlockTable();
        }
    });
</script>
@endsection