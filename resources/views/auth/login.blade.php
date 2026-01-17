<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAYABI - Masuk Akun</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
    </style>
</head>
<body class="bg-slate-950">

    <main class="min-h-screen relative overflow-hidden flex items-center justify-center p-4">
        
        <div class="absolute top-0 -left-20 w-96 h-96 bg-red-600/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <section class="w-full max-w-4xl mx-auto relative z-10">
            
            @if (session('status'))
                <div class="mb-4 bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl text-sm font-bold text-center">
                    {{ session('status') }}
                </div>
            @endif

            <div class="glass-card rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] border border-white/10 overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    
                    <div class="p-10 md:w-5/12 border-b md:border-b-0 md:border-r border-white/5 flex flex-col justify-center">
                        <div class="inline-block w-fit px-3 py-1 bg-red-600/20 border border-red-600/30 rounded-full mb-4">
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-[0.2em]">Secure Portal</p>
                        </div>
                        <h2 class="text-4xl font-black text-white uppercase italic tracking-tighter leading-none">
                            MASUK <br><span class="text-red-600">AKUN</span>
                        </h2>
                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-4 max-w-[200px]">
                            Akses dashboard premium Fayabi Workshop.
                        </p>
                    </div>

                    <div class="p-10 md:w-7/12 space-y-5">
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="grid grid-cols-1 gap-5">
                                
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                        <i class="fa-solid fa-envelope text-red-600"></i> Email Terdaftar
                                    </label>
                                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="name@example.com"
                                        class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-3.5 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 transition-all placeholder:text-slate-700">
                                    
                                    @error('email')
                                        <span class="text-red-500 text-xs font-bold ml-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                        <i class="fa-solid fa-lock text-red-600"></i> Password
                                    </label>
                                    <input type="password" name="password" required autocomplete="current-password"
                                        placeholder="••••••••"
                                        class="w-full bg-white/5 border-2 border-white/10 text-white px-5 py-3.5 rounded-2xl text-sm font-bold focus:outline-none focus:border-red-600 transition-all placeholder:text-slate-700">
                                    
                                    @error('password')
                                        <span class="text-red-500 text-xs font-bold ml-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-between px-1 mt-4">
                                <label class="flex items-center gap-2 text-[10px] font-bold text-slate-500 uppercase cursor-pointer hover:text-slate-300 transition-colors">
                                    <input type="checkbox" name="remember" class="accent-red-600 rounded bg-slate-800 border-slate-700"> Ingat Saya
                                </label>
                                
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[10px] font-black text-red-600 uppercase tracking-tighter hover:underline">
                                        Lupa?
                                    </a>
                                @endif
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                <button type="submit" class="flex-[2] bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl uppercase tracking-[0.2em] text-[11px] shadow-[0_10px_30px_rgba(220,0,46,0.3)] transition-all flex items-center justify-center gap-2 transform active:scale-95">
                                    MASUK <i class="fa-solid fa-right-to-bracket"></i>
                                </button>
                                
                                <a href="{{ route('register') }}" class="flex-1 border-2 border-white/10 text-slate-400 hover:text-white hover:border-white/30 font-black py-4 rounded-2xl uppercase tracking-[0.2em] text-[10px] transition-all flex items-center justify-center text-center">
                                    DAFTAR
                                </a>
                            </div>

                        </form>
                        </div>
                </div>
            </div>

            <p class="text-center mt-6 text-slate-700 text-[9px] font-black uppercase tracking-[0.4em]">
                Fayabi Workshop &copy; {{ date('Y') }} - Secure System
            </p>
        </section>
    </main>

</body>
</html>