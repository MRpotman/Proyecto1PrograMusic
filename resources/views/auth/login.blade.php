<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hikari's Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,.12);
            overflow: hidden;
            background: #fff;
        }

        .auth-header {
            background: #111;
            color: #fff;
            padding: 2rem;
            text-align: center;
        }
        .auth-header h2 { font-size: 1.4rem; margin: 0; letter-spacing: .5px; }
        .auth-header p  { font-size: .85rem; opacity: .6; margin: .25rem 0 0; }

        /* TABS */
        .auth-tabs {
            display: flex;
            border-bottom: 1px solid #eee;
        }
        .auth-tab {
            flex: 1;
            padding: .85rem;
            text-align: center;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            color: #888;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            transition: all .2s;
        }
        .auth-tab.active {
            color: #111;
            border-bottom: 3px solid #111;
        }

        .auth-body { padding: 1.75rem 2rem; }

        /* Panels */
        .auth-panel { display: none; }
        .auth-panel.active { display: block; }

        .form-control:focus { box-shadow: none; border-color: #111; }

        .btn-auth {
            background: #111;
            color: #fff;
            border: none;
            width: 100%;
            padding: .65rem;
            border-radius: 8px;
            letter-spacing: .3px;
            transition: background .2s;
        }
        .btn-auth:hover { background: #333; color: #fff; }
    </style>
</head>
<body>

<div class="auth-card">

    <!-- HEADER -->
    <div class="auth-header">
        <i class="bi bi-disc" style="font-size:2rem;"></i>
        <h2 class="mt-2">Hikari's Records</h2>
        <p>Your vinyl & music shop</p>
    </div>

    <!-- TABS -->
    <div class="auth-tabs">
        <button class="auth-tab active" onclick="switchTab('login')">
            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
        </button>
        <button class="auth-tab" onclick="switchTab('register')">
            <i class="bi bi-person-plus me-1"></i> Sign Up
        </button>
    </div>

    <div class="auth-body">

        @if($errors->any())
            <div class="alert alert-danger py-2 small mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- ===== LOGIN PANEL ===== -->
        <div class="auth-panel active" id="panel-login">

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="form-control"
                               placeholder="you@example.com" autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn btn-auth">Sign In</button>

            </form>

        </div>

        <!-- ===== REGISTER PANEL ===== -->
        <div class="auth-panel" id="panel-register">

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="mb-2">
                    <label class="form-label small fw-semibold">Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                        <input type="text" name="nombre"
                               value="{{ old('nombre') }}"
                               class="form-control"
                               placeholder="Your name">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label small fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="form-control"
                               placeholder="you@example.com">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label small fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Min. 6 characters">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label small fw-semibold">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password_confirmation"
                               class="form-control"
                               placeholder="Repeat password">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label small fw-semibold">Phone <span class="text-muted fw-normal">(optional)</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-telephone"></i></span>
                        <input type="text" name="telefono"
                               value="{{ old('telefono') }}"
                               class="form-control"
                               placeholder="+506 0000-0000">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold">Address <span class="text-muted fw-normal">(optional)</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-geo-alt"></i></span>
                        <input type="text" name="direccion"
                               value="{{ old('direccion') }}"
                               class="form-control"
                               placeholder="Your address">
                    </div>
                </div>

                <button type="submit" class="btn btn-auth">Create Account</button>

            </form>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Si hay errores y venían del register, abrir ese panel
    const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
    const oldAction = "{{ old('_action', 'login') }}"; // lo usamos abajo

    function switchTab(tab) {
        document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.auth-panel').forEach(p => p.classList.remove('active'));

        document.getElementById('panel-' + tab).classList.add('active');
        event.target.classList.add('active');
    }

    // Si hubo error en register, mantener ese panel abierto
    @if($errors->any() && old('nombre'))
        switchTab('register');
        document.querySelectorAll('.auth-tab')[1].classList.add('active');
        document.querySelectorAll('.auth-tab')[0].classList.remove('active');
    @endif
</script>

</body>
</html>