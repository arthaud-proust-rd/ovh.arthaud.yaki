@props(['count'])
<section class="pt-6 pb-4 px-2">
    <div class="border presence-ceil items-center flex-col p-2">
        <div class="flex flex-col items-start">
            <span>{{ trans_choice('resume_count_eat', $count['eat']) }}</span>
            <span>{{ trans_choice('resume_count_sleep', $count['sleep']) }}</span>
        </div>
    </div>
</section>
