<footer class="bg-white rounded-lg shadow  m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between mb-4">
            <a href="{{ route('home') }}" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-red-500">CityChatter</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 ">
                <li>
                    <a href="{{ route('about') }}" class="hover:underline me-4 md:me-6">About</a>
                </li>
                <li>
                    <a href="{{ route('mission') }}" class="hover:underline me-4 md:me-6">Mission</a>
                </li>
                <li>
                    <a href="{{ route('privacy-policy') }}" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="{{ route('terms') }}" class="hover:underline me-4 md:me-6">Terms</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="hover:underline me-4 md:me-6">Contact</a>
                </li>
                <li>
                    <a href="{{ route('help') }}" class="hover:underline">Help</a>
                </li>
            </ul>
        </div>
        <span class="block text-sm text-gray-500 sm:text-center ">© 2023 <a href="{{ route('home') }}" class="hover:underline">CityChatter</a>. All Rights Reserved.</span>
        <br />
        <div class="block text-sm text-gray-500 sm:text-center ">
            Curated by <a href="https://roilift.com/" rel="nofollow" class="hover:underline">Roilift</a>
        </div>
    </div>

    <button id="add-to-home-screen" class="fixed bottom-4 right-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full shadow-lg z-50">
    Add to Home Screen
</button>

<script>
    let deferredPrompt;

window.addEventListener('beforeinstallprompt', (event) => {
    // Prevent the mini-infobar from appearing on mobile
    event.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = event;
    // Update UI to notify the user they can add to home screen
    const addToHomeScreenButton = document.getElementById('add-to-home-screen');
    addToHomeScreenButton.classList.remove('hidden');

    addToHomeScreenButton.addEventListener('click', () => {
        // Hide the button
        addToHomeScreenButton.classList.add('hidden');
        // Show the install prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the A2HS prompt');
            } else {
                console.log('User dismissed the A2HS prompt');
            }
            deferredPrompt = null;
        });
    });
});

// Optional: Handle the appinstalled event
window.addEventListener('appinstalled', () => {
    console.log('Application has been installed.');
    // You can hide the button after installation
    document.getElementById('add-to-home-screen').classList.add('hidden');
});

</script>
</footer>