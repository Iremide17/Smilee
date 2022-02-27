<button {{ $attributes->merge(['type' => 'submit', 'class' =>
 'px-4 py-1 text-sm text-gray-50 font-semibold uppercase rounded-full bg-theme-blue-100 border border-white-200 hover:text-red-600
 hover:bg-theme-blue-200 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 tracking-widest active:bg-theme-blue-300 transition'
  ]) }}>
    {{ $slot }}
</button>
