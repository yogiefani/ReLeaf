<x-app-layout>
    @include('components.jumbotron-primary')
    @include('components.featured-books')
    @include('components.jumbotron-books')
    <x-book-categories />
    <x-about-us-section />
    <x-testimonials-section />
    <x-airbooks-picks />
    <x-media-partners />
    <x-what-you-get />
    <x-faq-section />

</x-app-layout>