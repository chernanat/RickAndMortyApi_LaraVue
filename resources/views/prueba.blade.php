<x-app-layout>
    <section>
        {{$person}}
        <main>
            <index-user :person="{{$person}}"></index-user>
        </main>
    </section>
</x-app-layout>