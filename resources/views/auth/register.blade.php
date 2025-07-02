@extends('layouts.auth')

@php($title = 'Criar conta')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full mt-1 p-2 rounded-lg border border-gray-300 focus:ring-[#653C8B] focus:border-[#653C8B]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full mt-1 p-2 rounded-lg border border-gray-300 focus:ring-[#653C8B] focus:border-[#653C8B]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" required
                   class="w-full mt-1 p-2 rounded-lg border border-gray-300 focus:ring-[#653C8B] focus:border-[#653C8B]">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Confirmar senha</label>
            <input type="password" name="password_confirmation" required
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
            Criar conta
        </button>

        <div class="text-sm text-center mt-4">
            Já tem conta?
            <a href="{{ route('login') }}" class="text-[#653C8B] hover:underline">Entrar</a>
        </div>
    </form>
@endsection
