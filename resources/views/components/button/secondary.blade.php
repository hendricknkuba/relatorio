<button {{ $attributes->merge(['class' => 'px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondaryHover transition']) }}>
    {{ $slot }}
</button>
