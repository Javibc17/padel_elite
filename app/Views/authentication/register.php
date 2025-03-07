<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crea una Cuenta</title>
    <meta name="description" content="Crea una cuenta en Padel Elite" />
    <meta name="keywords" content="Padel, Registro, Sign Up" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        var loginUrl = "<?= base_url('login') ?>";
    </script>
</head>
<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(<?= base_url('assets/media/illustrations/sketchy-1/14.png') ?>)">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid ">
                <!--begin::Logo-->
                <a href="<?= base_url('/') ?>" class="mb-12">
                    <img alt="Logo" src="<?= base_url('assets/media/logos/padel.svg') ?>" class="h-100px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-600px bg-body rounded shadow-sm p-5 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="post" action="<?= base_url('auth/processRegister') ?>">
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Crea una Cuenta</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">¿Ya tienes una cuenta?
                                <a href="<?= base_url('login') ?>" class="link-primary fw-bolder">Iniciar Sesión</a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Messages-->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        <!--end::Messages-->

                        <!--begin::Input group-->
                        <div class="row fv-row mb-7">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Nombre</label>
                                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="nombre" autocomplete="off" required />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6">Teléfono</label>
                                <input class="form-control form-control-lg form-control-solid" type="tel" placeholder="" name="telefono" autocomplete="off" pattern="\d{9}" title="El teléfono debe tener 9 números" required />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" required />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6">Contraseña</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="contraseña" autocomplete="off" required />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Hint-->
                            <div class="text-muted">Usa 8 o más caracteres, usa letras mayúsculas y minúsculas, números y simbolos.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6">Confirmar Contraseña</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm-password" autocomplete="off" required />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Rol</label>
                            <select class="form-select form-select-lg form-select-solid" name="rol" required>
                                <option value="cliente">Cliente</option>
                                <option value="monitor">Monitor</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input" type="checkbox" name="toc" value="1" required />
                                <span class="form-check-label fw-bold text-gray-700 fs-6">Acepto los
                                    <a href="#" class="ms-1 link-primary">Terminos y Condiciones</a>.
                                </span>
                            </label>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Enviar</span>
                                <span class="indicator-progress">Por favor, espera...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            <div class="d-flex flex-center flex-column-auto p-10">
                <!--begin::Links-->
                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Main-->
    <script>var hostUrl = "<?= base_url('assets/') ?>";</script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="<?= base_url('assets/js/custom/authentication/sign-up/general.js') ?>"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
</html>