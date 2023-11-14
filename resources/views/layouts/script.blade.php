
<!-- JS Global Compulsory  -->
<script src={{asset('assets/vendor/jquery/dist/jquery.min.js')}}></script>
<script src={{asset('assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}></script>
<script src={{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}></script>
<!-- JS Implementing Plugins -->
<script src="{{asset('assets/vendor/hs-file-attach/dist/hs-file-attach.min.js')}}"></script>
<script src={{asset('assets/vendor/datatables/media/js/jquery.dataTables.min.js')}}></script>
<script src={{asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js')}}></script>
<script src={{asset('assets/vendor/hs-form-search/dist/hs-form-search.min.js')}}></script>
<!-- JS Front -->
<script src={{asset('assets/js/theme.min.js')}}></script>
<!-- JS Plugins Init. -->
<script>
    (function() {
        // INITIALIZATION OF NAVBAR VERTICAL ASIDE
        // =======================================================
        new HSSideNav('.js-navbar-vertical-aside').init()


        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        new HSFormSearch('.js-form-search')

        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        HSBsDropdown.init()
    })()
</script>
<!-- Style Switcher JS -->
<script>
    (function () {
        // STYLE SWITCHER
        // =======================================================
        const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
        const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

        // Function to set active style in the dorpdown menu and set icon for dropdown trigger
        const setActiveStyle = function () {
            $variants.forEach($item => {
                if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                    $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                    return $item.classList.add('active')
                }

                $item.classList.remove('active')
            })
        }

        // Add a click event to all items of the dropdown to set the style
        $variants.forEach(function ($item) {
            $item.addEventListener('click', function () {
                HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
            })
        })

        // Call the setActiveStyle on load page
        setActiveStyle()

        // Add event listener on change style to call the setActiveStyle function
        window.addEventListener('on-hs-appearance-change', function () {
            setActiveStyle()
        })
    })()
</script>
<!-- End Style Switcher JS -->
<script>
    (function () {
        // INITIALIZATION OF DATATABLES
        // =======================================================
        HSCore.components.HSDatatables.init('.js-datatable')
    })()
</script>
<script>
    (function() {
        // INITIALIZATION OF FILE ATTACH
        // =======================================================
        new HSFileAttach('.js-file-attach')
    })();
</script>


