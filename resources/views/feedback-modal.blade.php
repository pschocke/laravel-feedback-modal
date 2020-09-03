<div x-data="{ open: false, send: false }" @keydown.window.escape="open = false"
     x-init="
         @this.on('change-send', () => {
             send = !send;
         })
    "
    >
    <div class="fixed bottom-0 right-0 top-0 flex items-center">
        <div class="transform -rotate-90 origin-bottom-right">
            <button x-on:click="open = true" class=" bg-gray-900 text-white p-3 rounded-t-lg" style="">
                @lang("feedback-modal::feedback-modal.button")
            </button>
        </div>
    </div>
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 overflow-hidden">
            <section class="absolute inset-y-0 pl-16 max-w-full right-0 flex">
                <div class="w-screen max-w-md pointer-events-auto" x-description="Slide-over panel, show/hide based on slide-over state." x-show="open" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                    <div class="h-full divide-y divide-gray-200 flex flex-col bg-white shadow-xl">
                        <div class="flex-1 flex flex-col h-0 overflow-y-auto">
                            <header class="space-y-1 py-6 px-4 bg-indigo-700 sm:px-6">
                                <div class="flex items-center justify-between space-x-3">
                                    <h2 class="text-lg leading-7 font-medium text-white">
                                        @lang("feedback-modal::feedback-modal.headline")
                                    </h2>
                                    <div class="h-7 flex items-center">
                                        <button @click="open = false" aria-label="Close panel" class="text-indigo-200 hover:text-white transition ease-in-out duration-150">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm leading-5 text-indigo-300">
                                        @lang("feedback-modal::feedback-modal.subheadline")
                                    </p>
                                </div>
                            </header>
                            <div x-show="send" class="flex-1 flex justify-center items-center">
                               <div class="flex flex-col justify-center">
                                   <div class="flex justify-center">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                       </svg>
                                   </div>
                                   <h3 class="text-lg leading-6 font-medium text-gray-900 px-3 mt-4 text-center">
                                       @lang("feedback-modal::feedback-modal.thanks_and_saved_headline")
                                   </h3>
                                   <p class="p-3 text-center">
                                       @lang("feedback-modal::feedback-modal.thanks_and_saved_text")
                                   </p>
                               </div>
                            </div>
                            <div x-show="!send" class="flex-1 flex flex-col justify-between">
                                <div class="px-4 divide-y divide-gray-200 sm:px-6">
                                    <fieldset class="space-y-2 my-4">
                                        <legend class="text-sm leading-5 font-medium text-gray-900">
                                            @lang("feedback-modal::feedback-modal.feedback.type")
                                        </legend>
                                        <div class="space-y-5">
                                            @foreach(trans("feedback-modal::feedback-modal.feedback.types") as $key => $val)
                                                <div>
                                                    <div class="relative flex items-start">
                                                        <div class="absolute flex items-center h-5">
                                                            <input wire:model="type" id="{{ $key }}" aria-describedby="{{ $key }}_description" type="radio" value="{{ $key }}" class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                                        </div>
                                                        <div class="pl-7 text-sm leading-5">
                                                            <label for="{{ $key }}" class="font-medium text-gray-900">
                                                                {{ $val['title'] }}
                                                            </label>
                                                            <p id="{{ $key }}_description" class="text-gray-500">
                                                                {{ $val['description'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error("type")
                                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                        @enderror
                                    </fieldset>
                                    <div class="space-y-6 pt-6 pb-5">
                                        <div class="space-y-1">
                                            <label for="description" class="block text-sm font-medium leading-5 text-gray-900">
                                                @lang("feedback-modal::feedback-modal.attributes.feedback")
                                            </label>
                                            <div class="relative rounded-md shadow-sm">
                                                <textarea wire:model="feedback" id="description" rows="4" class="form-input block w-full sm:text-sm sm:leading-5 transition ease-in-out duration-150"></textarea>
                                            </div>
                                            @error("feedback")
                                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="space-y-1">
                                            <div class="flex justify-between">
                                                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">@lang("feedback-modal::feedback-modal.attributes.email")</label>
                                                <span class="text-sm leading-5 text-gray-500" id="email-optional">@lang("feedback-modal::feedback-modal.optional")</span>
                                            </div>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input wire:model="email" id="email" class="form-input block w-full sm:text-sm sm:leading-5" aria-describedby="email-optional">
                                            </div>
                                            @error("email")
                                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="space-y-1">
                                            <div class="flex items-center">
                                                <input wire:model="data_protection" id="remember_me" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                                <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900">
                                                    @lang("feedback-modal::feedback-modal.data_protection")
                                                </label>
                                            </div>
                                            @error("data_protection")
                                            <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="space-y-4 pt-4 pb-6">
                                        <div class="text-sm leading-5" x-data="{extra: false}">
                                            <a href="#" x-on:click.prevent="extra = !extra" class="group space-x-2 inline-flex items-center text-gray-500 hover:text-gray-900 transition ease-in-out duration-150">
                                                <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span>
                                                  @lang("feedback-modal::feedback-modal.why-email")
                                                </span>
                                            </a>
                                            <div x-show.transition="extra">
                                            <p class="ml-7">
                                                @lang("feedback-modal::feedback-modal.why-email-description")
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="!send" class="flex-shrink-0 px-4 py-4 space-x-4 flex justify-end">
                            <span class="inline-flex rounded-md shadow-sm">
                                <button @click="open = false" type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                    @lang("feedback-modal::feedback-modal.cancel")
                                </button>
                            </span>
                            <span class="inline-flex rounded-md shadow-sm">
                                <button wire:click="send" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    @lang("feedback-modal::feedback-modal.send")
                                </button>
                            </span>
                        </div>
                        <div x-show="send" class="flex-shrink-0 px-4 py-4 space-x-4 flex justify-end">
                            <span class="inline-flex rounded-md shadow-sm">
                                <button @click="open = false" type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                                    @lang("feedback-modal::feedback-modal.close")
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
