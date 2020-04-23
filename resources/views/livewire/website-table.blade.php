<div>
    <h1 class="inline-block py-2 text-2xl font-semibold ">Website Creators</h1>
    <div class="flex items-center justify-between">
        <div>
            <label class="flex items-center justify-center">
                <span class="pr-1 text-gray-700">Per Page</span>
                <select class="mt-1 form-select" wire:model="perPage">
                  <option>10</option>
                  <option>25</option>
                  <option>100</option>
                </select>
              </label>
        </div>
        <div>
            <input 
            class="w-40 mt-1 form-input sm:w-64" 
            placeholder="Search Website..."
            wire:model='search'
            >
        </div>
    </div>

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
                    @if ($website->alexa_ranking)
                        {{number_format($website->alexa_ranking)}}                    
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex flex-col items-center justify-between mt-6 xl:flex-row">
        {{$websites->links()}}
        <div class="my-6">Showing {{$websites->firstItem()}} out {{$websites->lastItem()}} out of {{$websites->total()}} websites</div>
    </div>
</div>
