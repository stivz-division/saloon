<div>
    <div class="p-3 rounded-4 bg-light">
        <label class="form-label h2" for="ref_link">
            {{ __("Реферальная ссылка") }}
        </label>

        <div class="position-relative">
            <input class="form-control form-control-lg" id="ref_link" type="text"
                   value="{{ route('register', ['ref_uuid' => $user->uuid]) }}"
                   readonly>

            <div class="position-absolute p-1" id="ref_button" style="right: 0; top: 0; bottom: 1px">
                <button type="button" class="btn btn-primary">
                    <i id="copy_icon" class="bi bi-clipboard"></i>
                    <i id="success_copy_icon" class="d-none bi bi-check2-circle"></i>
                </button>
            </div>
        </div>


    </div>
</div>

@push('scripts')
    <script type="application/javascript">
      (_ => {
        const button = document.querySelector('#ref_button');

        const link = document.querySelector('#ref_link');

        const copyIcon = document.querySelector('#copy_icon');

        const successCopyIcon = document.querySelector('#success_copy_icon');

        button.addEventListener('click', _ => {

          navigator.clipboard.writeText(link.value);

          successCopyIcon.classList.remove('d-none');
          copyIcon.classList.add('d-none');
        });

      })();
    </script>
@endpush
