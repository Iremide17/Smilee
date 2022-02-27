<div class="col-md-3 transition duration-500 transform shadow-lg hover:shadow-xl hover:scale-105" data-aos="fade-up">
    <a href="{{ route('smilee.tags.show', $model) }}" class="relative col-span-1 cursor-pointer hover:shadow">

        <img class="w-full h-full transition-all obeject-cover opacity-80 duration-250 hover:opacity-100" src="{{ asset('storage/' . $model->image()) }}" alt="{{ $model->name() }}">

        <h2 class="absolute inset-x-auto w-full py-2 font-serif text-5xl font-bold text-center text-white bg-gray-600 bg-opacity-50 text-shadow top-2/4">
            {{ $model->name() }}
        </h2>
    </a>
</div>