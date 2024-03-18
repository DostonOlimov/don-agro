{{-- start down button style --}}
<style>
    #scrollToBottomBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: none;
        }
    .block-for-print {
        display: none;
    }

    @media print {
        .block-for-print {
            display: block;
            width: 100px;

            @if (count($test->application->crops->name->nds) > 1)
                height: 1400px;
            @else
                height: 100px;
            @endif
        }
    }
</style>
{{-- end down button style --}}
<div id="invoice-cheque" class="py-4 col-12 {{ $classes ?? '' }}" style=" font-family: Times New Roman;">
    @for ($i = 0; $i < $test->akt[0]->party_number; $i++)
        @include('laboratory_protocol._cheque')
        <div class="block-for-print"></div>
    @endfor
</div>
    <button id="scrollToBottomBtn"><i class="fas fa-chevron-down"></i></button>

{{-- start down button script --}}
<script>
function isPageBottom() {
        return window.innerHeight + window.scrollY >= document.body.offsetHeight;
    }

    function handleScroll() {
        if (isPageBottom()) {
            document.getElementById('scrollToBottomBtn').style.display = 'block';
        } else {
            document.getElementById('scrollToBottomBtn').style.display = 'none';
            }
    }

    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }

    window.addEventListener('scroll', handleScroll);

        document.getElementById('scrollToBottomBtn').addEventListener('click', scrollToBottom);
</script>
{{-- end down button script --}}
