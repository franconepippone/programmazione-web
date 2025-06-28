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
        "image" => "https://www.gannett-cdn.com/-mm-/11209fb2def8be382b823d16ad1cec8e92fddfbf/c=0-210-5184-3126/local/-/media/AsburyPark/2014/12/07/B9315404032Z.1_20141207054645_000_GQQ9ALD42.1-0.jpg?width=3200&height=1680&fit=crop",
        "link" => "#"
    ],
    [
        "name" => "Padel for Intermediates",
        "start_date" => "2025-07-15",
        "image" => "https://www.gannett-cdn.com/-mm-/11209fb2def8be382b823d16ad1cec8e92fddfbf/c=0-210-5184-3126/local/-/media/AsburyPark/2014/12/07/B9315404032Z.1_20141207054645_000_GQQ9ALD42.1-0.jpg?width=3200&height=1680&fit=crop",
        "link" => "#"
    ],
    [
        "name" => "Tennis Techniques 101",
        "start_date" => "2025-08-01",
        "image" => "https://www.gannett-cdn.com/-mm-/11209fb2def8be382b823d16ad1cec8e92fddfbf/c=0-210-5184-3126/local/-/media/AsburyPark/2014/12/07/B9315404032Z.1_20141207054645_000_GQQ9ALD42.1-0.jpg?width=3200&height=1680&fit=crop",
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
    ["name" => "Carlos Linares", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Ana Torres", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Luis Navarro", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Elena Sánchez", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Miguel Ortega", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Lucía Rivas", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Daniel Vélez", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Paula Ruiz", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Santiago Vidal", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"],
    ["name" => "Clara Mendoza", "image" => "https://i1.rgstatic.net/ii/profile.image/792008453005319-1565840938681_Q512/Carlos-Linares-Koloffon.jpg"]
]}

{assign var="fields" value=[
    ["name" => "Football", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"],
    ["name" => "Padel", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"],
    ["name" => "Tennis", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"],
    ["name" => "Swimming", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"],
    ["name" => "Basketball", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"],
    ["name" => "Gym", "image" => "https://th.bing.com/th/id/R.47a753a2aebdff63eb16a87b73084962?rik=AZy90cAwum4Atg&pid=ImgRaw&r=0"]
]}


{block name="content"}
<div class="container my-5">

    <!-- Featured Courses Section -->
    <section class="mb-5">
        <div class="d-flex flex-column align-items-center text-center mb-3">
            <h2 class="mb-4">Featured courses</h2>
        </div>
        <div id="courses-scroll" class="auto-scroll-container overflow-auto scroll-container" style="scroll-behavior: smooth;">
            <div class="d-flex flex-row gap-3" style="min-width: 100%;">
                {foreach $featured_courses as $course}
                    <div class="card shadow-sm" style="min-width: 250px; flex: 0 0 auto;">
                        <div style="height: 300px; overflow: hidden;">
                            <img src="{$course.image}" class="card-img-top img-fluid" alt="Course image for {$course.name}" style="height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body py-2">
                            <h6 class="card-title mb-1">{$course.name}</h6>
                            <p class="card-text mb-2 small text-muted">Start Date: {$course.start_date}</p>
                        </div>
                        <div class="card-footer py-2 bg-white border-0">
                            <a href="{$course.link}" class="btn btn-sm btn-primary w-100">View</a>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </section>

    <!-- Our Instructors Section -->
    <section class="mb-5">
        <div class="d-flex flex-column align-items-center text-center mb-3">
            <h2 class="mb-4">Our Instructors</h2>
        </div>
        <div id="instructors-scroll" class="auto-scroll-container overflow-auto scroll-container" style="max-width: 600px; margin: 0 auto;">
            <div class="d-flex flex-row align-items-center gap-2" style="min-width: 100%;">
                {foreach $instructors as $instructor}
                    <div class="card text-center shadow-sm" style="min-width: 140px; flex: 0 0 auto;">
                        <div class="p-2 d-flex flex-column align-items-center">
                            <img src="{$instructor.image}" class="rounded-circle img-fluid mb-2" alt="Profile picture of {$instructor.name}" style="width: 70px; height: 70px; object-fit: cover;">
                            <h6 class="mb-0" style="font-size: 0.9rem;">{$instructor.name}</h6>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </section>

    <!-- Our Fields Section -->
    <section class="mb-5">
        <div class="d-flex flex-column align-items-center text-center mb-3">
            <h2 class="mb-4">Our Fields</h2>
        </div>
        <div id="fields-scroll" class="auto-scroll-container overflow-auto scroll-container" style="scroll-behavior: smooth;">
            <div class="d-flex flex-row align-items-center gap-3" style="min-width: 100%;">
                {foreach $fields as $field}
                    <div class="card shadow-sm" style="min-width: 250px; flex: 0 0 auto;">
                        <div style="height: 400px; overflow: hidden;">
                            <img src="{$field.image}" class="card-img-top img-fluid" alt="Image of {$field.name}" style="height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body py-2 text-center">
                            <h6 class="card-title mb-0">{$field.name}</h6>
                        </div>
                        <div class="card-footer py-2 bg-white border-0">
                            <a href="#" class="btn btn-sm btn-primary w-100">Details</a>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </section>

    <!-- Where Are We Section -->
    <section class="mb-5">
        <div class="d-flex flex-column align-items-center text-center mb-4">
            <h2 class="mb-4">Where are we</h2>
        </div>
        <div class="d-flex justify-content-center">
        <div style="width: 100%; max-width: 800px; height: 400px;">
            <iframe
            class="w-100"
            height="320"
            style="border:0;"
            loading="lazy"
            allowfullscreen
            referrerpolicy="no-referrer-when-downgrade"
            src="https://maps.google.com/maps?q=42.36283778342318, 13.346947387935332&hl=it&z=15&output=embed">
          </iframe>
        </div>
        </div>
    
    </section>


</div>
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

