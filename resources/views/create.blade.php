<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="p-4 mx-auto max-w-xl bg-white">
        <h2 class="text-3xl text-slate-900 font-bold">Contact us</h2>
        @if ($contactFormPackageError)
            {!! $contactFormPackageError !!}

        @else

            @session('success')
                <div class="text-sm text-green-500">{{ session('success') }}</div>
            @endsession
            <form action="submit/message" method="POST" class="mt-8 space-y-5">
                @csrf
                <div>
                    <label class='text-sm text-slate-900 font-medium mb-2 block'>Name</label>
                    <input type='text' placeholder='Enter Name' name="name"
                        class="w-full py-2.5 px-4 text-slate-800 bg-gray-100 border border-gray-200 focus:border-slate-900 focus:bg-transparent text-sm outline-0 transition-all" />
                    @error('name')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class='text-sm text-slate-900 font-medium mb-2 block'>Email</label>
                    <input type='email' placeholder='Enter Email' name="email"
                        class="w-full py-2.5 px-4 text-slate-800 bg-gray-100 border border-gray-200 focus:border-slate-900 focus:bg-transparent text-sm outline-0 transition-all" />
                        @error('email')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                </div>
                <div>
                    <label class='text-sm text-slate-900 font-medium mb-2 block'>Subject</label>
                    <input type='text' placeholder='Enter Subject' name="subject"
                        class="w-full py-2.5 px-4 text-slate-800 bg-gray-100 border border-gray-200 focus:border-slate-900 focus:bg-transparent text-sm outline-0 transition-all" />
                        @error('email')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                </div>
                
                <div>
                    <label class='text-sm text-slate-900 font-medium mb-2 block'>Message</label>
                    <textarea placeholder='Enter Message' rows="6" name="message"
                        class="w-full px-4 text-slate-800 bg-gray-100 border border-gray-200 focus:border-slate-900 focus:bg-transparent text-sm pt-3 outline-0 transition-all"></textarea>
                        @error('message')
                            <div class="text-sm text-red-500">{{ $message }}</div>
                        @enderror
                </div>
                <button type='submit' class="text-white bg-slate-900 font-medium hover:bg-slate-800 tracking-wide text-sm px-4 py-2.5 w-full border-0 outline-0 cursor-pointer">
                    Send message
                </button>
            </form>

        @endif
        
    </div>
</body>

</html>