<header class="antialiased">
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center">
            <div class="flex justify-start items-center">
                <!-- Logo dan nama perlu diganti -->
                <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="FlowBite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </div>
            <div class="flex items-center lg:order-2">
                <!-- set period -->
                <details class="relative">
                    <summary class="cursor-pointer flex items-center">
                        <div type="button" class="inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 
                            focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3.5 py-2 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 
                            focus:outline-none dark:focus:ring-primary-800">
                            Set Period
                        </div>
                    </summary>

                    <!-- Dropdown menu -->
                    <div
                        class="absolute right-0 mt-2 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <div class="py-3 px-4">
                            <label for="selectMonth"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Month</label>
                            <select id="selectMonth"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="py-3 px-4">
                            <label for="inputYear"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Year</label>
                            <input type="number" id="inputYear"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md"
                                value="{{ date('Y') }}">
                        </div>

                        <button
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-3 py-2"
                            id="applyPeriodButton">Set</button>
                    </div>
                </details>

                <!-- new transaction -->
                <details class="relative">
                    <summary class="cursor-pointer flex items-center">
                        <div type="button" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 
                focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 
                focus:outline-none dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            New Transaction
                        </div>
                    </summary>

                    <!-- Dropdown menu -->
                    <div
                        class="absolute right-0 mt-2 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <!-- <div class="py-3 px-4">
                            <a href="/create-transaction">
                                <button type="button"
                                    class="inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800">Income</button>
                            </a>
                            <span
                                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->username }}</span>
                        </div> -->
                        <ul class="block text-sm font-semibold text-gray-900 dark:text-white">
                            <li>
                                <!-- <a href="/income/{{ Auth::user()->username }}/create" -->
                                <a href="/income/create"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Add Income</a>
                            </li>
                            <li>
                            <!-- <a href="/outcome/{{ Auth::user()->username }}/create" -->
                            <a href="/outcome/create"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Add Outcome</a>
                            </li>
                        </ul>
                    </div>
                </details>

                <!-- Dropdown menggunakan <details> dan <summary> -->
                <details class="relative">
                    <summary
                        class="cursor-pointer flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user">
                    </summary>
                    <!-- Dropdown menu -->
                    <div
                        class="absolute right-0 mt-2 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <div class="py-3 px-4">
                            <span
                                class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->username }}</span>
                        </div>
                        <ul class="py-1 text-gray-500 dark:text-gray-400">
                            <li>
                                <a href="/profile/{{ Auth::user()->username }}"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                    profile</a>
                            </li>
                            <li>
                                <form action="/logout" method="post"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </details>
            </div>
        </div>
    </nav>
</header>