{{--
    Tampilan KTA responsif (depan & belakang) untuk halaman web.
    Parameter: data dari KtaService::cardData(), opsional $sides (default ['front', 'back'])
--}}
@include('member.kta.style')
<style>
    .kta-display { width: 100%; aspect-ratio: 85.6 / 54; position: relative; overflow: hidden;
        border-radius: 3%/5%; box-shadow: 0 4px 16px rgba(0, 0, 0, .15); }
    .kta-display .kta-card { position: absolute; top: 0; left: 0; transform-origin: 0 0; }
</style>

@foreach ($sides ?? ['front', 'back'] as $side)
    <div class="kta-display {{ $loop->last ? '' : 'mb-3' }}">
        @include('member.kta.card', ['side' => $side])
    </div>
@endforeach

<script>
    (function () {
        function scaleKta() {
            document.querySelectorAll('.kta-display').forEach(function (wrapper) {
                var card = wrapper.querySelector('.kta-card');
                if (card && card.offsetWidth) {
                    card.style.transform = 'scale(' + (wrapper.clientWidth / card.offsetWidth) + ')';
                }
            });
        }
        window.addEventListener('resize', scaleKta);
        document.addEventListener('DOMContentLoaded', scaleKta);
        document.addEventListener('shown.bs.tab', scaleKta);
        document.addEventListener('slid.bs.carousel', scaleKta);
        scaleKta();
    })();
</script>
