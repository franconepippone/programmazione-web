{extends file=$layout}
{assign var="page_title" value="Home"}

{block name="styles"}    <style>
        .scroll-container {
            overflow-x: auto;
            overflow-y: hidden;
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;     /* Firefox */
            }

            .scroll-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */a
            }
    </style>
{/block}

{assign var="featured_courses" value=[
    [
        "name" => "Beginner Football Training",
        "start_date" => "2025-07-10",
        "image" => "https://th.bing.com/th/id/R.c141f053756ce848378899536757e431?rik=w2lOqmpD1%2bPW6A&pid=ImgRaw&r=0",
        "link" => "#"
    ],
    [
        "name" => "Padel for Intermediates",
        "start_date" => "2025-07-15",
        "image" => "https://parksports.co.uk/media/images/Sports/Padel/_1200xAUTO_crop_center-center_none/Adult-Padel-Courses.jpg",
        "link" => "#"
    ],
    [
        "name" => "Tennis Techniques 101",
        "start_date" => "2025-08-01",
        "image" => "https://th.bing.com/th/id/R.1002a334fd591923db090e1e9d25635a?rik=Uo6VPnC2q2sQbg&riu=http%3a%2f%2fwww.tennisiconuk.com%2fwp-content%2fuploads%2f2016%2f05%2fevents_1.jpg&ehk=vmAyP11OyTriQrS6UX%2bDjBolwM62j6C3vVcmk65Fn8M%3d&risl=&pid=ImgRaw&r=0",
        "link" => "#"
    ],
    [
        "name" => "Swimming for Beginners",
        "start_date" => "2025-08-10",
        "image" => "https://www.gannett-cdn.com/-mm-/11209fb2def8be382b823d16ad1cec8e92fddfbf/c=0-210-5184-3126/local/-/media/AsburyPark/2014/12/07/B9315404032Z.1_20141207054645_000_GQQ9ALD42.1-0.jpg?width=3200&height=1680&fit=crop",
        "link" => "#"
    ]
]}
{assign var="instructors" value=[
    ["name" => "Carlos Linares", "image" => "https://as1.ftcdn.net/v2/jpg/05/40/94/56/1000_F_540945602_Z4vikFTHWKuX7B0ncuAZf22Fh4yrdYNF.jpg"],
    ["name" => "Ana Torres", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Luis Navarro", "image" => "https://i.pinimg.com/originals/f8/66/8e/f8668e5328cfb4938903406948383cf6.png"],
    ["name" => "Elena Sánchez", "image" => "https://media.istockphoto.com/id/1253034963/photo/smart-businessman-smiling-at-camera-wearing-round-glasses-isolated-on-gray-background.jpg?s=612x612&w=0&k=20&c=i3KBjpmwOq6mtTGbvmKTm6ZEm3RsAh3FUWoL4d6y4nA="],
    ["name" => "Miguel Ortega", "image" => "https://media.istockphoto.com/id/856797530/es/foto/retrato-de-una-mujer-hermosa-en-el-gimnasio.jpg?s=612x612&w=0&k=20&c=PKkXypaXFdO72AGyU7gbXMYIXUrDKeI-9REDOV592Gs="],
    ["name" => "Lucía Rivas", "image" => "https://tse4.mm.bing.net/th/id/OIP.d0UCkZZuenLP4zQ61mbnjwHaHa?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3"],
    ["name" => "Daniel Vélez", "image" => "https://tse1.explicit.bing.net/th/id/OIP.Kuzs4QPin3bQFop1kbnq6AHaHa?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3"],
    ["name" => "Paula Ruiz", "image" => "https://loopyball.com/wp-content/uploads/2018/04/chefin-1.jpg"],
    ["name" => "Santiago Vidal", "image" => "https://i.pinimg.com/originals/fd/e3/b8/fde3b8a7a48aa75a15758b27e30212d1.png"],
    ["name" => "Clara Mendoza", "image" => "https://c8.alamy.com/comp/H3E85X/portrait-of-happy-man-standing-with-a-tennis-racket-H3E85X.jpg"]
]}

{assign var="fields" value=[
    ["name" => "Football", "image" => "https://th.bing.com/th/id/R.38b5f9e531f99f1da1602a4193eca444?rik=P4GzSvYthANwkg&pid=ImgRaw&r=0"],
    ["name" => "Padel", "image" => "https://hellopadelacademy.com/wp-content/uploads/2021/05/RACKET_CLUB_1914_LOW_sRGB-1024x682.jpg"],
    ["name" => "Tennis", "image" => "https://web-assets.playfinder.com/wp-content/uploads/2017/12/27164007/Grass-Court-synthetic-tennis_2.jpg"],
    ["name" => "Swimming", "image" => "https://www.britishswimming.org/media/images/14.width-600.jpg"],
    ["name" => "Basketball", "image" => "https://d2gg9evh47fn9z.cloudfront.net/1600px_COLOURBOX23298301.jpg"],
    ["name" => "Gym", "image" => "https://st2.depositphotos.com/1017228/7108/i/950/depositphotos_71080145-stock-photo-gym-interior-with-equipment.jpg"]
]}

{block name="content"}
<style>
  /* Scroll buttons */
  .scroll-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    width: 5rem;
    height: 5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 20;
    opacity: 0.1;
    transition: opacity 0.3s ease;
  }
  .scroll-btn:hover {
    opacity: .6;
  }
  .scroll-btn-left {
    left: -3rem;
  }
  .scroll-btn-right {
    right: -3rem;
  }

  /* Black arrows - override Bootstrap carousel icons */
  .scroll-btn .carousel-control-prev-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0L4.5 1 7 4 4.5 7 5.5 8 9 4 5.5 0z'/%3E%3C/svg%3E");
    width: 3rem;
    height: 3rem;
  }
  .scroll-btn .carousel-control-next-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 8 8'%3E%3Cpath d='M2.5 0L3.5 1 1 4 3.5 7 2.5 8-1 4 2.5 0z'/%3E%3C/svg%3E");
    width: 3rem;
    height: 3rem;
  }

  /* Container for scroll + arrows, relative for absolute arrows */
  .scroll-wrapper {
    position: relative;
  }

  /* Gradient fade overlays on scroll edges */
  .scroll-fade-left,
  .scroll-fade-right {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 3rem;
    pointer-events: none;
    z-index: 15;
  }
  .scroll-fade-left {
    left: 0;
    background: linear-gradient(to right, white 0%, rgba(255,255,255,0) 100%);
  }
  .scroll-fade-right {
    right: 0;
    background: linear-gradient(to left, white 0%, rgba(255,255,255,0) 100%);
  }

  /* Fade-in animation */
  .fade-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
  }
  .fade-section.visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Cards hover scale & shadow */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }
  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    z-index: 10;
  }

  /* Cards specifics */
  #fields-scroll .card {
    width: 320px !important; /* Bigger fields cards */
  }
  #instructors-scroll .card {
    width: 180px !important;
  }
  #courses-scroll .card {
    min-width: 360px !important;
  }
</style>

<div class="container my-5">

  <!-- Corsi in evidenza -->
  <section class="fade-section mb-5 pb-4 border-bottom border-2 border-secondary-subtle">
    <div class="text-center mb-4 position-relative">
      <h2 class="fw-bold fs-2 d-inline-block border-bottom border-3 border-primary pb-2">Corsi in evidenza</h2>
      <p class="text-muted fst-italic fs-5 mt-3">Scopri le nostre sessioni di allenamento più popolari</p>
    </div>
    <div class="scroll-wrapper">
      <button class="scroll-btn scroll-btn-left" data-target="#courses-scroll" aria-label="Scorri a sinistra" type="button">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Precedente</span>
      </button>
      <div id="courses-scroll" class="scroll-container d-flex gap-5 overflow-auto pb-3" style="scroll-behavior: smooth; padding: 0 2rem;">
        {foreach $featured_courses as $course}
        <a href="{$course.link}" class="card shadow-sm text-decoration-none text-dark flex-shrink-0" style="min-width: 360px;">
          <div class="ratio ratio-4x3 overflow-hidden rounded-top" style="height: 270px;">
            <img src="{$course.image}" alt="Immagine del corso {$course.name}" class="card-img-top object-fit-cover">
          </div>
          <div class="card-body py-4">
            <h5 class="card-title fw-semibold mb-2 fs-4">{$course.name}</h5>
            <p class="card-text text-muted small mb-0 fs-5">Data inizio: {$course.start_date}</p>
          </div>
        </a>
      {/foreach}
      </div>
      <div class="scroll-fade-left"></div>
      <div class="scroll-fade-right"></div>
      <button class="scroll-btn scroll-btn-right" data-target="#courses-scroll" aria-label="Scorri a destra" type="button">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Successivo</span>
      </button>
    </div>
  </section>

  <!-- I nostri istruttori -->
  <section class="fade-section mb-5 pb-4 border-bottom border-2 border-secondary-subtle">
    <div class="text-center mb-4 position-relative">
      <h2 class="fw-bold fs-2 d-inline-block border-bottom border-3 border-success pb-2">I nostri istruttori</h2>
      <p class="text-muted fst-italic fs-5 mt-3">Incontra i professionisti che ti guideranno</p>
    </div>
    <div class="scroll-wrapper" style="max-width: 900px; margin: 0 auto;">
      <button class="scroll-btn scroll-btn-left" data-target="#instructors-scroll" aria-label="Scorri a sinistra" type="button">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Precedente</span>
      </button>
      <div id="instructors-scroll" class="scroll-container d-flex gap-4 overflow-auto justify-content-center pb-3" style="padding: 0 2rem;">
        {foreach $instructors as $instructor}
        <a href="#" class="card shadow-sm text-decoration-none text-dark text-center flex-shrink-0" style="width: 180px;">
          <div class="card-body py-4">
            <img src="{$instructor.image}" alt="Foto di {$instructor.name}" class="rounded-circle mb-4" style="width: 120px; height: 120px; object-fit: cover;">
            <h6 class="card-title fw-semibold mb-0 fs-4">{$instructor.name}</h6>
          </div>
        </a>
        {/foreach}
      </div>
      <div class="scroll-fade-left"></div>
      <div class="scroll-fade-right"></div>
      <button class="scroll-btn scroll-btn-right" data-target="#instructors-scroll" aria-label="Scorri a destra" type="button">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Successivo</span>
      </button>
    </div>
  </section>

  <!-- Campi disponibili -->
  <section class="fade-section mb-5 pb-4 border-bottom border-2 border-secondary-subtle">
    <div class="text-center mb-4 position-relative">
      <h2 class="fw-bold fs-2 d-inline-block border-bottom border-3 border-warning pb-2">Campi disponibili</h2>
      <p class="text-muted fst-italic fs-5 mt-3">Scegli l’ambiente sportivo perfetto per te</p>
    </div>
    <div class="scroll-wrapper" style="max-width: 1000px; margin: 0 auto;">
      <button class="scroll-btn scroll-btn-left" data-target="#fields-scroll" aria-label="Scorri a sinistra" type="button">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Precedente</span>
      </button>
      <div id="fields-scroll" class="scroll-container d-flex gap-5 overflow-auto pb-3 justify-content-center" style="padding: 0 2rem;">
        {foreach $fields as $field}
        <a href="#" class="card shadow-sm flex-shrink-0 text-decoration-none text-dark" style="width: 320px;">
          <div class="ratio ratio-1x1 overflow-hidden rounded-top" style="height: 320px;">
            <img src="{$field.image}" alt="Immagine di {$field.name}" class="card-img-top object-fit-cover">
          </div>
          <div class="card-body py-3 text-center">
            <h6 class="card-title fw-semibold mb-0 fs-4">{$field.name}</h6>
          </div>
        </a>
        {/foreach}
      </div>
      <div class="scroll-fade-left"></div>
      <div class="scroll-fade-right"></div>
      <button class="scroll-btn scroll-btn-right" data-target="#fields-scroll" aria-label="Scorri a destra" type="button">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Successivo</span>
      </button>
    </div>
  </section>

  <!-- Dove siamo -->
  <section class="fade-section my-5">
    <div class="text-center mb-4 position-relative">
      <h2 class="fw-bold fs-2 d-inline-block border-bottom border-3 border-info pb-2">Dove siamo</h2>
      <p class="text-muted fst-italic fs-5 mt-3 mb-5">Vieni a trovarci o contattaci!</p>
    </div>

    <div class="d-flex flex-column flex-md-row gap-4 justify-content-center align-items-start" style="max-width: 900px; margin: 0 auto; padding: 0 2rem;">
      <div class="flex-fill" style="min-width: 280px;">
        <h5 class="fw-semibold mb-3">La nostra sede</h5>
        <p class="text-muted fs-5">
          Via degli Sportivi, 123<br>
          Città dello Sport, ST 45678<br>
          Telefono: (123) 456-7890<br>
          Email: info@sportscenter.com<br><br>
          Ti aspettiamo per visitare le nostre strutture o per qualsiasi informazione.
        </p>
      </div>

      <div class="flex-fill" style="min-width: 320px; height: 320px; border-radius: 0.3rem; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <iframe
          src="https://maps.google.com/maps?q=42.349998,13.399999&hl=it&z=15&output=embed"
          loading="lazy"
          allowfullscreen
          referrerpolicy="no-referrer-when-downgrade"
          style="border:0; width: 100%; height: 100%;">
        </iframe>  
      </div>
    </div>
  </section>

</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Fade in each section individually when visible
    const fadeSections = document.querySelectorAll('.fade-section');
    const observerOptions = { threshold: 0.1 };
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);
    fadeSections.forEach(section => observer.observe(section));

    // Scroll buttons
    document.querySelectorAll('.scroll-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const target = document.querySelector(btn.getAttribute('data-target'));
        if (!target) return;
        const scrollAmount = btn.classList.contains('scroll-btn-left') ? -350 : 350;
        target.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      });
    });
  });
</script>
{/block}


{block name="scripts"}
    {literal}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const containers = document.querySelectorAll('.auto-scroll-container');

            containers.forEach(container => {
                function wheelHandler(e) {
                    // Prevent default vertical scroll and scroll horizontally instead
                    e.preventDefault();
                    container.scrollLeft += e.deltaY;
                }

                container.addEventListener('wheel', wheelHandler, { passive: false });
            });
        });
    </script>
    {/literal}
{/block}

