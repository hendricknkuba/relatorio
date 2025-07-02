@extends('layouts.auth')

@php($title = 'Login')
@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full mt-1 p-2 rounded-lg border border-gray-300 focus:ring-[#653C8B] focus:border-[#653C8B]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" required
                   class="w-full mt-1 p-2 rounded-lg border border-gray-300 focus:ring-[#653C8B] focus:border-[#653C8B]">
        </div>

        @if ($errors->any())
            <div class="text-sm text-red-600">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit"
                class="w-full py-2 px-4 bg-[#653C8B] text-white rounded-lg hover:bg-[#4e2f6d] transition-colors">
            Entrar
        </button>

        <div class="text-sm text-center mt-4">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="text-[#653C8B] hover:underline">Criar conta</a>
        </div>
    </form>
@endsection
