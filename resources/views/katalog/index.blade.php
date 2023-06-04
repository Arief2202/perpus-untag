@extends('layouts.main')
@section('navKatalogClass') active @endsection

@section('title')
Badan Perpustakaan Untag Surabaya
@endsection
@section('style')
    <style>
        p {
          display: inline;
          color:#686868;
        }
        #more{
          color:#686868;
          font-size: 15px;
          margin-top:20px;
        }
        #myInput {
        background-image: url('/img/search.png'); /* Add a search icon to input */
        background-size: 25px;
        background-position: 10px 12px; /* Position the search icon */
        background-repeat: no-repeat; /* Do not repeat the icon image */
        width: 100%; /* Full-width */
        font-size: 16px; /* Increase font-size */
        padding: 12px 20px 12px 50px; /* Add some padding */
        border: 1px solid #ddd; /* Add a grey border */
        margin-bottom: 12px; /* Add some space below the input */
        }

        #books {
        /* Remove default list styling */
        list-style-type: none;
        padding: 0;
        margin: 0;
        }

        #books li a {
          border: 2px solid #ddd; /* Add a border to all links */
          margin-top: 10px; /* Prevent double borders */
          background-color: #ffffff; /* Grey background color */
          border-radius: 10px;
          padding: 12px; /* Add some padding */
          text-decoration: none; /* Remove default text underline */
          font-size: 18px; /* Increase the font-size */
          color: black; /* Add a black text color */
          display: block; /* Make it into a block element to fill the whole list */
        }

        #books li a:hover:not(.header) {
        background-color: #eee; /* Add a hover effect to all links, except for headers */
        }
    </style>
@endsection


@section('content')
  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="content" class="content">
      <div class="container">
        <input type="text" id="myInput" onkeyup="update()" placeholder="Search for names..">

        <ul id="books">
            @foreach($bukus as $a=>$buku)
            <li>
                {{-- <a href="#">{{ fake()->unique()->name() }}</a> --}}
                <a href="/katalog/{{ $buku->id }}">
                  <div class="row">
                    <div class="col-lg-2 d-flex justify-content-center">
                      @if($buku->sampul)
                        <img src="{{ $buku->sampul }}" height="200px">
                      @else
                        <img src="/img/NoImage.png" height="200px">
                      @endif
                    </div>
                    <div class="col-lg">
                      <div id="judul"><b>{{ $buku->judul }}</b></div>
                      <div id="klas">No. Klas : <p>{{ $buku->no_inventaris }}</p></div>
                      <div id="pengarang">Pengarang : <p>{{ $buku->pengarang }}</p></div>
                      <div id="penerbit">Penerbit : <p>{{ $buku->impresium }}</p></div>
                      <div id="kolasi">Kolasi : <p>{{ $buku->kolasi }}</p></div>
                      <div id="more">More Details >></p></div>
                    </div>
                  </div>
                </a>
            </li>
            @endforeach
        </ul>
      </div>
    </section>
    
  </main><!-- End #main -->

@endsection

@section('script')
  <script type="text/javascript">
        function update() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('myInput');
            filter = input.value.toUpperCase();
            ul = document.getElementById("books");
            li = ul.getElementsByTagName('li');

            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }
  </script>
@endsection