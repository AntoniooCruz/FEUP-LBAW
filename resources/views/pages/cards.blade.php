@extends('layouts.app')

@section('title', 'Cards')

@section('content')

<section id="cards">
  @each('partials.card', $cards, 'card')
  <article class="card">
      <input type="text" name="name" placeholder="new card">
  </article>
</section>

@endsection
