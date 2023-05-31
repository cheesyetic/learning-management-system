@extends('content/general/layouts/horizontalLayout')

@section('title', 'Buttons - UI elements')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">UI elements /</span>
        Buttons
    </h4>

    <div class="row">
        <!-- Basic Buttons -->

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Basic Buttons</h5>
                <div class="card-body">
                    <small class="text-light fw-semibold">Default</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-primary">Primary</button>
                        <button type="button" class="btn btn-secondary">Secondary</button>
                        <button type="button" class="btn btn-success">Success</button>
                        <button type="button" class="btn btn-danger">Danger</button>
                        <button type="button" class="btn btn-warning">Warning</button>
                        <button type="button" class="btn btn-info">Info</button>
                        <button type="button" class="btn btn-dark">Dark</button>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <small class="text-light fw-semibold">Rounded</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn rounded-pill btn-primary">Primary</button>
                        <button type="button" class="btn rounded-pill btn-secondary">Secondary</button>
                        <button type="button" class="btn rounded-pill btn-success">Success</button>
                        <button type="button" class="btn rounded-pill btn-danger">Danger</button>
                        <button type="button" class="btn rounded-pill btn-warning">Warning</button>
                        <button type="button" class="btn rounded-pill btn-info">Info</button>
                        <button type="button" class="btn rounded-pill btn-dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Label Buttons -->

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Label Buttons</h5>
                <div class="card-body">
                    <small class="text-light fw-semibold">Default</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-label-primary">Primary</button>
                        <button type="button" class="btn btn-label-secondary">Secondary</button>
                        <button type="button" class="btn btn-label-success">Success</button>
                        <button type="button" class="btn btn-label-danger">Danger</button>
                        <button type="button" class="btn btn-label-warning">Warning</button>
                        <button type="button" class="btn btn-label-info">Info</button>
                        <button type="button" class="btn btn-label-dark">Dark</button>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <small class="text-light fw-semibold">Rounded</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn rounded-pill btn-label-primary">Primary</button>
                        <button type="button" class="btn rounded-pill btn-label-secondary">Secondary</button>
                        <button type="button" class="btn rounded-pill btn-label-success">Success</button>
                        <button type="button" class="btn rounded-pill btn-label-danger">Danger</button>
                        <button type="button" class="btn rounded-pill btn-label-warning">Warning</button>
                        <button type="button" class="btn rounded-pill btn-label-info">Info</button>
                        <button type="button" class="btn rounded-pill btn-label-dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outline Buttons -->

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Outline Buttons</h5>
                <div class="card-body">
                    <small class="text-light fw-semibold">Default</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-outline-primary">Primary</button>
                        <button type="button" class="btn btn-outline-secondary">Secondary</button>
                        <button type="button" class="btn btn-outline-success">Success</button>
                        <button type="button" class="btn btn-outline-danger">Danger</button>
                        <button type="button" class="btn btn-outline-warning">Warning</button>
                        <button type="button" class="btn btn-outline-info">Info</button>
                        <button type="button" class="btn btn-outline-dark">Dark</button>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <small class="text-light fw-semibold">Rounded</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn rounded-pill btn-outline-primary">Primary</button>
                        <button type="button" class="btn rounded-pill btn-outline-secondary">Secondary</button>
                        <button type="button" class="btn rounded-pill btn-outline-success">Success</button>
                        <button type="button" class="btn rounded-pill btn-outline-danger">Danger</button>
                        <button type="button" class="btn rounded-pill btn-outline-warning">Warning</button>
                        <button type="button" class="btn rounded-pill btn-outline-info">Info</button>
                        <button type="button" class="btn rounded-pill btn-outline-dark">Dark</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons with Icons -->

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Buttons with Icons</h5>
                <div class="row row-bordered g-0">
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Basic</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn rounded-pill btn-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Label</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-label-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn btn-label-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-label-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn rounded-pill btn-label-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Outline</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-outline-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn btn-outline-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-outline-primary">
                                <span class="ti-xs ti ti-star me-1"></span>Primary
                            </button>
                            <button type="button" class="btn rounded-pill btn-outline-secondary">
                                <span class="ti-xs ti ti-bell me-1"></span>Secondary
                            </button>
                        </div>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="row row-bordered g-0">
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Basic</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn btn-icon btn-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Label</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-label-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn btn-icon btn-label-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-label-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-label-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Outline</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn btn-icon btn-outline-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-outline-primary">
                                <span class="ti ti-star"></span>
                            </button>
                            <button type="button" class="btn rounded-pill btn-icon btn-outline-secondary">
                                <span class="ti ti-bell"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Button -->

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Social Button</h5>
                <div class="row row-bordered g-0">
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Basic</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-facebook"><i
                                    class="tf-icons ti ti-brand-facebook ti-xs me-1"></i> Facebook</button>
                            <button type="button" class="btn btn-twitter"><i
                                    class="tf-icons ti ti-brand-twitter ti-xs me-1"></i> Twitter</button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-google-plus">
                                <i class="tf-icons ti ti-brand-google ti-xs me-1"></i> Google+
                            </button>
                            <button type="button" class="btn rounded-pill btn-instagram">
                                <i class="tf-icons ti ti-brand-instagram ti-xs me-1"></i> Instagram
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Label</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-label-linkedin"><i
                                    class="tf-icons ti ti-brand-linkedin ti-xs me-1"></i> Linkedin</button>
                            <button type="button" class="btn btn-label-github"><i
                                    class="tf-icons ti ti-brand-github ti-xs me-1"></i> Github</button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-label-pinterest"> <i
                                    class="tf-icons ti ti-brand-pinterest ti-xs me-1"></i> Pinterest </button>
                            <button type="button" class="btn rounded-pill btn-label-slack"> <i
                                    class="tf-icons ti ti-brand-slack ti-xs me-1"></i> Slack </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Outline</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-outline-dribbble"> <i
                                    class="tf-icons ti ti-brand-dribbble ti-xs me-1"></i> Dribbble </button>
                            <button type="button" class="btn btn-outline-reddit"><i
                                    class="tf-icons ti ti-brand-reddit ti-xs me-1"></i> Reddit</button>
                        </div>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn rounded-pill btn-outline-youtube"> <i
                                    class="tf-icons ti ti-brand-youtube ti-xs me-1"></i> Youtube </button>
                            <button type="button" class="btn rounded-pill btn-outline-vimeo"> <i
                                    class="tf-icons ti ti-brand-vimeo ti-xs me-1"></i> Vimeo </button>
                        </div>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="row row-bordered g-0">
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Basic Icons</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-facebook"><i
                                    class="tf-icons ti ti-brand-facebook"></i></button>
                            <button type="button" class="btn btn-icon btn-twitter"><i
                                    class="tf-icons ti ti-brand-twitter"></i></button>
                            <button type="button" class="btn btn-icon rounded-pill btn-google-plus">
                                <i class="tf-icons ti ti-brand-google"></i>
                            </button>
                            <button type="button" class="btn btn-icon rounded-pill btn-instagram">
                                <i class="tf-icons ti ti-brand-instagram"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Label Icons</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-label-linkedin"><i
                                    class="tf-icons ti ti-brand-linkedin"></i></button>
                            <button type="button" class="btn btn-icon btn-label-github"><i
                                    class="tf-icons ti ti-brand-github"></i></button>
                            <button type="button" class="btn btn-icon rounded-pill btn-label-pinterest">
                                <i class="tf-icons ti ti-brand-pinterest"></i>
                            </button>
                            <button type="button" class="btn btn-icon rounded-pill btn-label-slack">
                                <i class="tf-icons ti ti-brand-slack"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 p-4">
                        <small class="text-light fw-semibold">Outline Icons</small>
                        <div class="demo-inline-spacing">
                            <button type="button" class="btn btn-icon btn-outline-dribbble">
                                <i class="tf-icons ti ti-brand-dribbble"></i>
                            </button>
                            <button type="button" class="btn btn-icon btn-outline-reddit"><i
                                    class="tf-icons ti ti-brand-reddit"></i></button>
                            <button type="button" class="btn btn-icon rounded-pill btn-outline-youtube">
                                <i class="tf-icons ti ti-brand-youtube"></i>
                            </button>
                            <button type="button" class="btn btn-icon rounded-pill btn-outline-vimeo">
                                <i class="tf-icons ti ti-brand-vimeo"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button Options -->
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Button Options</h5>
                <div class="card-body">
                    <small class="text-light fw-semibold">Sizes</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-xl btn-primary">Button xl</button>
                        <button type="button" class="btn btn-lg btn-primary">Button lg</button>
                        <button type="button" class="btn btn-primary">Button</button>
                        <button type="button" class="btn btn-sm btn-primary">Button sm</button>
                        <button type="button" class="btn btn-xs btn-primary">Button xs</button>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <small class="text-light fw-semibold">Buttons State</small>
                    <div class="demo-inline-spacing">
                        <button type="button" class="btn btn-primary">Normal</button>
                        <button type="button" class="btn btn-primary active">Active</button>
                        <button type="button" class="btn btn-primary" disabled>Disabled</button>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <small class="text-light fw-semibold">Block level buttons</small>
                    <div class="row mt-3">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                            <button class="btn btn-primary btn-lg" type="button">Button</button>
                            <button class="btn btn-secondary btn-lg" type="button">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button Plugin -->
        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header">Button Plugin</h5>
                <div class="row row-bordered g-0">
                    <div class="col-xl-3 p-4">
                        <div class="text-light small fw-semibold">Toggle states</div>
                        <div class="demo-vertical-spacing">
                            <button type="button" class="btn btn-primary d-block" data-bs-toggle="button"
                                autocomplete="off">Toggle button</button>
                            <button type="button" class="btn btn-primary active d-block" data-bs-toggle="button"
                                autocomplete="off" aria-pressed="true">Active toggle button</button>
                            <button type="button" class="btn btn-primary d-block" disabled data-bs-toggle="button"
                                autocomplete="off">Disabled toggle button</button>
                        </div>
                    </div>
                    <div class="col-xl-3 p-4">
                        <div class="text-light small fw-semibold">Checkbox toggle buttons</div>
                        <div class="demo-vertical-spacing">
                            <div class="d-block">
                                <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off">
                                <label class="btn btn-primary" for="btn-check">Single toggle</label>
                            </div>
                            <div class="d-block">
                                <input type="checkbox" class="btn-check" id="btn-check-2" checked autocomplete="off">
                                <label class="btn btn-primary" for="btn-check-2">Checked</label>
                            </div>
                            <div class="d-block">
                                <input type="checkbox" class="btn-check" id="btn-check-3" checked autocomplete="off">
                                <label class="btn btn-primary" for="btn-check-3">Checked</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 p-4">
                        <div class="text-light small fw-semibold">Checkbox and radio</div>

                        <div class="demo-vertical-spacing">
                            <!-- Checkbox -->

                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1" checked autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1 (pre-checked)</label>

                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>

                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
                            </div>


                            <br />

                            <!-- Radio -->

                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                    autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button Group -->
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Button Group</h5>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <small class="text-light fw-semibold">Basic</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-secondary">Left</button>
                                    <button type="button" class="btn btn-secondary">Middle</button>
                                    <button type="button" class="btn btn-secondary">Right</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <small class="text-light fw-semibold">Label</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-label-secondary">Left</button>
                                    <button type="button" class="btn btn-label-secondary">Middle</button>
                                    <button type="button" class="btn btn-label-secondary">Right</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <small class="text-light fw-semibold">Outline</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-secondary">Left</button>
                                    <button type="button" class="btn btn-outline-secondary">Middle</button>
                                    <button type="button" class="btn btn-outline-secondary">Right</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-xl-0 mb-3">
                            <small class="text-light fw-semibold">Button Toolbar</small>
                            <div class="btn-toolbar demo-inline-spacing" role="toolbar"
                                aria-label="Toolbar with button groups">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-bell"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-clipboard"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-device-tv"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-browser-check"></i></button>
                                </div>
                                <div class="btn-group" role="group" aria-label="Second group">
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-bold"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-italic"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-underline"></i></button>
                                </div>
                                <div class="btn-group" role="group" aria-label="Third group">
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-volume-2"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <small class="text-light fw-semibold">Button Nesting</small>
                            <div class="mt-3">
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-truck"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-sun"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"><i
                                            class="ti ti-cloud"></i></button>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button"
                                            class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Dropdown link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
