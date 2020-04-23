<div>
    <h1 class="inline-block py-2 text-2xl font-semibold ">Website Creators</h1>
    <table class="w-full">
        <thead>
            <tr>
            <th class="px-2 py-4 text-left">Website</th>
            <th class="px-2 py-4 text-left">Alexa Ranking</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($websites as $website)
            <tr>
                <td class="px-2 py-4 border">{{$website->name}}</td>
                <td class="px-2 py-4 border">
                   {{$website->friendly_alexa_ranking()}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex flex-col items-center justify-between mt-6 xl:flex-row">
        {{$websites->links()}}
    </div>
</div>
