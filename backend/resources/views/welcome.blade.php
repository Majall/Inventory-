<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Inventory') }}</title>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full antialiased">
        <div class="min-h-screen flex bg-slate-50 dark:bg-slate-950">
            <aside class="hidden lg:flex lg:flex-col lg:w-64 border-r border-slate-200/70 dark:border-slate-800 bg-white dark:bg-slate-900">
                <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-200/70 dark:border-slate-800">
                    <div class="h-10 w-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-semibold">IM</div>
                    <div>
                        <p class="text-sm font-semibold">Inventory</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Operations Suite</p>
                    </div>
                </div>
                <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Dashboard
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium" href="#">
                        <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                        Product Management
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Supplier Management
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Category Management
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Warehouse Management
                    </a>
                    <div class="pt-4">
                        <p class="px-3 text-xs font-semibold uppercase text-slate-400">Inventory Flow</p>
                    </div>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Stock In / Out
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Sales Orders
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Purchase Orders
                    </a>
                    <div class="pt-4">
                        <p class="px-3 text-xs font-semibold uppercase text-slate-400">Insights</p>
                    </div>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Reports & Analytics
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800" href="#">
                        <span class="h-2 w-2 rounded-full bg-slate-400"></span>
                        Settings
                    </a>
                </nav>
                <div class="px-6 py-4 border-t border-slate-200/70 dark:border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-full bg-slate-200 dark:bg-slate-800"></div>
                        <div class="text-sm">
                            <p class="font-medium">Olivia Parker</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Admin</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-1 flex flex-col">
                <header class="sticky top-0 z-10 bg-white/95 dark:bg-slate-900/95 backdrop-blur border-b border-slate-200/70 dark:border-slate-800">
                    <div class="flex items-center justify-between px-4 py-4 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button class="lg:hidden flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700" data-mobile-nav-toggle aria-label="Open menu">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 5h14M3 10h14M3 15h14" />
                                </svg>
                            </button>
                            <div>
                                <p class="text-xs uppercase tracking-wide text-slate-400">Inventory</p>
                                <h1 class="text-lg font-semibold">Product Management</h1>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative hidden md:block">
                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.414-1.414l3.387 3.387a1 1 0 01-1.414 1.414l-3.387-3.387zM14 9a5 5 0 11-10 0 5 5 0 0110 0z" clip-rule="evenodd" />
                                </svg>
                                <input class="w-72 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 py-2 pl-9 pr-3 text-sm shadow-sm focus:border-indigo-500 focus:outline-none" placeholder="Search products" />
                            </div>
                            <button class="hidden sm:flex items-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-2 text-sm" data-theme-toggle>
                                <span class="text-xs uppercase text-slate-500">Theme</span>
                                <span class="font-medium text-slate-700 dark:text-slate-200" data-theme-label>Light</span>
                            </button>
                            <button class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 dark:border-slate-700" aria-label="Notifications">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z" />
                                    <path d="M10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                </svg>
                            </button>
                            <div class="flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 px-2 py-1">
                                <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                                <span class="text-sm font-medium">Olivia</span>
                                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.082l3.71-3.85a.75.75 0 011.08 1.04l-4.24 4.4a.75.75 0 01-1.08 0l-4.24-4.4a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 px-4 py-6 lg:px-8 lg:py-8 space-y-8">
                    <section class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold">Products</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Track SKUs, stock levels, suppliers, and expiry status across warehouses.</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-4 py-2 text-sm">Export CSV</button>
                            <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-500" data-modal-open="product">Add Product</button>
                        </div>
                    </section>

                    <section class="grid gap-4 md:grid-cols-3">
                        <div class="rounded-xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
                            <p class="text-xs uppercase text-slate-400">Total Products</p>
                            <p class="mt-2 text-2xl font-semibold">1,248</p>
                            <p class="text-xs text-emerald-500">+12 this week</p>
                        </div>
                        <div class="rounded-xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
                            <p class="text-xs uppercase text-slate-400">Low Stock Alerts</p>
                            <p class="mt-2 text-2xl font-semibold">18</p>
                            <p class="text-xs text-amber-500">6 need reorder</p>
                        </div>
                        <div class="rounded-xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-4">
                            <p class="text-xs uppercase text-slate-400">Inactive SKUs</p>
                            <p class="mt-2 text-2xl font-semibold">42</p>
                            <p class="text-xs text-slate-500">Last updated 2d ago</p>
                        </div>
                    </section>

                    <section class="rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 space-y-4">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex flex-1 flex-wrap items-center gap-3">
                                <div class="relative flex-1 min-w-[240px]">
                                    <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M12.9 14.32a7 7 0 111.414-1.414l3.387 3.387a1 1 0 01-1.414 1.414l-3.387-3.387zM14 9a5 5 0 11-10 0 5 5 0 0110 0z" clip-rule="evenodd" />
                                    </svg>
                                    <input class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 py-2 pl-9 pr-3 text-sm" placeholder="Search by name, SKU, barcode" />
                                </div>
                                <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                                    <option>All Categories</option>
                                    <option>Electronics</option>
                                    <option>Medical</option>
                                    <option>Office Supplies</option>
                                </select>
                                <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                                    <option>Status: All</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                                <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm">
                                    <option>Sort: Latest</option>
                                    <option>Sort: Name A-Z</option>
                                    <option>Sort: Stock Low</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <span class="rounded-full bg-emerald-100 text-emerald-700 px-2 py-1">Live</span>
                                <span>Updated 2 minutes ago</span>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="text-xs uppercase text-slate-400">
                                    <tr class="border-b border-slate-200/70 dark:border-slate-800">
                                        <th class="py-3 text-left font-semibold">
                                            <div class="flex items-center gap-1">Product
                                                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 4l4 4H6l4-4zM10 16l-4-4h8l-4 4z" />
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="py-3 text-left font-semibold">SKU</th>
                                        <th class="py-3 text-left font-semibold">Category</th>
                                        <th class="py-3 text-left font-semibold">Supplier</th>
                                        <th class="py-3 text-left font-semibold">Cost</th>
                                        <th class="py-3 text-left font-semibold">Selling</th>
                                        <th class="py-3 text-left font-semibold">Qty</th>
                                        <th class="py-3 text-left font-semibold">Status</th>
                                        <th class="py-3 text-left font-semibold">Updated</th>
                                        <th class="py-3 text-right font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200/70 dark:divide-slate-800">
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                        <td class="py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-lg bg-slate-200 dark:bg-slate-700"></div>
                                                <div>
                                                    <p class="font-medium">Pulse Oximeter Pro</p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">Barcode: 89234-PR</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>OXI-1002</td>
                                        <td>Medical</td>
                                        <td>Healix Supplies</td>
                                        <td>$45.00</td>
                                        <td>$68.00</td>
                                        <td class="font-medium text-amber-600">14</td>
                                        <td>
                                            <span class="rounded-full bg-emerald-100 text-emerald-700 px-2 py-1 text-xs">Active</span>
                                        </td>
                                        <td>May 10, 2026</td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-2">
                                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1 text-xs" data-modal-open="product">Edit</button>
                                                <button class="rounded-lg border border-rose-200 text-rose-600 px-3 py-1 text-xs" data-modal-open="delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                        <td class="py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-lg bg-slate-200 dark:bg-slate-700"></div>
                                                <div>
                                                    <p class="font-medium">Smart Shelf Labels</p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">Barcode: 77211-SL</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>SHE-3421</td>
                                        <td>Electronics</td>
                                        <td>NovaTech</td>
                                        <td>$18.00</td>
                                        <td>$27.50</td>
                                        <td class="font-medium text-emerald-600">242</td>
                                        <td>
                                            <span class="rounded-full bg-emerald-100 text-emerald-700 px-2 py-1 text-xs">Active</span>
                                        </td>
                                        <td>May 9, 2026</td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-2">
                                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1 text-xs" data-modal-open="product">Edit</button>
                                                <button class="rounded-lg border border-rose-200 text-rose-600 px-3 py-1 text-xs" data-modal-open="delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                        <td class="py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="h-10 w-10 rounded-lg bg-slate-200 dark:bg-slate-700"></div>
                                                <div>
                                                    <p class="font-medium">Ergo Desk Kit</p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">Barcode: 33301-ED</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>DES-5532</td>
                                        <td>Office Supplies</td>
                                        <td>Urban Workspace</td>
                                        <td>$120.00</td>
                                        <td>$164.00</td>
                                        <td class="font-medium text-rose-500">4</td>
                                        <td>
                                            <span class="rounded-full bg-slate-200 text-slate-700 px-2 py-1 text-xs dark:bg-slate-700 dark:text-slate-200">Inactive</span>
                                        </td>
                                        <td>May 6, 2026</td>
                                        <td class="text-right">
                                            <div class="flex justify-end gap-2">
                                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1 text-xs" data-modal-open="product">Edit</button>
                                                <button class="rounded-lg border border-rose-200 text-rose-600 px-3 py-1 text-xs" data-modal-open="delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200/70 dark:border-slate-800 pt-4 text-sm">
                            <p class="text-slate-500 dark:text-slate-400">Showing 1-3 of 1,248 products</p>
                            <div class="flex items-center gap-2">
                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1">Previous</button>
                                <button class="rounded-lg bg-indigo-600 px-3 py-1 text-white">1</button>
                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1">2</button>
                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1">3</button>
                                <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-3 py-1">Next</button>
                            </div>
                        </div>

                        <div class="hidden" data-state="loading">
                            <div class="flex items-center gap-3 rounded-xl border border-slate-200/70 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/60 px-4 py-6">
                                <div class="h-6 w-6 animate-spin rounded-full border-2 border-indigo-500 border-t-transparent"></div>
                                <p class="text-sm text-slate-500">Loading products...</p>
                            </div>
                        </div>
                        <div class="hidden" data-state="empty">
                            <div class="flex flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 dark:border-slate-700 px-6 py-10 text-center">
                                <div class="h-12 w-12 rounded-full bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-500">
                                    <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-2.414-2.414A2 2 0 0013.586 3H4z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 font-medium">No products yet</h3>
                                <p class="text-sm text-slate-500">Add your first product to start tracking stock levels.</p>
                                <button class="mt-4 rounded-lg bg-indigo-600 px-4 py-2 text-sm text-white" data-modal-open="product">Add Product</button>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>

        <div class="fixed inset-0 z-40 hidden" data-mobile-nav>
            <div class="absolute inset-0 bg-slate-900/60" data-mobile-nav-close></div>
            <aside class="relative h-full w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800">
                <div class="flex items-center justify-between px-4 py-4 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-semibold">IM</div>
                        <p class="font-semibold">Inventory</p>
                    </div>
                    <button class="h-9 w-9 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700" data-mobile-nav-close>
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6.707 5.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 001.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586 6.707 5.293z" />
                        </svg>
                    </button>
                </div>
                <nav class="px-4 py-4 space-y-2 text-sm">
                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300" href="#">Product Management</a>
                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300" href="#">Supplier Management</a>
                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300" href="#">Category Management</a>
                    <a class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-600 dark:text-slate-300" href="#">Warehouse Management</a>
                </nav>
            </aside>
        </div>

        <div class="fixed inset-0 z-50 hidden" data-modal="product">
            <div class="absolute inset-0 bg-slate-900/60" data-modal-close></div>
            <div class="absolute right-0 top-0 h-full w-full max-w-xl bg-white dark:bg-slate-900 shadow-xl overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 px-6 py-4">
                    <div>
                        <h3 class="text-lg font-semibold">Add Product</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Capture core product details and pricing.</p>
                    </div>
                    <button class="h-9 w-9 flex items-center justify-center rounded-lg border border-slate-200 dark:border-slate-700" data-modal-close>
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6.707 5.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 001.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586 6.707 5.293z" />
                        </svg>
                    </button>
                </div>
                <form class="space-y-6 px-6 py-6" data-product-form>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="text-sm font-medium">Name</label>
                            <input class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="name" data-required="true" placeholder="Product name" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="name">Name is required.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">SKU</label>
                            <input class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="sku" data-required="true" placeholder="SKU code" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="sku">SKU is required.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Barcode</label>
                            <input class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="barcode" placeholder="Optional" />
                            <p class="mt-1 text-xs text-slate-400">Unique barcode (optional).</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Category</label>
                            <select class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="category_id" data-required="true">
                                <option value="">Select category</option>
                                <option>Electronics</option>
                                <option>Medical</option>
                                <option>Office Supplies</option>
                            </select>
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="category_id">Category is required.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Supplier</label>
                            <select class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="supplier_id">
                                <option value="">Select supplier</option>
                                <option>NovaTech</option>
                                <option>Healix Supplies</option>
                                <option>Urban Workspace</option>
                            </select>
                            <p class="mt-1 text-xs text-slate-400">Optional supplier reference.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Status</label>
                            <select class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="status" data-required="true">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="status">Status is required.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Cost Price</label>
                            <input type="number" min="0" step="0.01" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="cost_price" data-required="true" placeholder="0.00" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="cost_price">Cost price must be 0 or more.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Selling Price</label>
                            <input type="number" min="0" step="0.01" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="selling_price" data-required="true" placeholder="0.00" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="selling_price">Selling price must be 0 or more.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Quantity</label>
                            <input type="number" min="0" step="1" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="quantity" data-required="true" placeholder="0" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="quantity">Quantity must be 0 or more.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Reorder Level</label>
                            <input type="number" min="0" step="1" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="reorder_level" data-required="true" placeholder="0" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="reorder_level">Reorder level must be 0 or more.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Expiry Date</label>
                            <input type="date" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="expiry_date" />
                            <p class="mt-1 text-xs text-rose-500 hidden" data-error="expiry_date">Expiry date must be today or later.</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Product Image</label>
                            <div class="mt-2 flex items-center gap-3 rounded-lg border border-dashed border-slate-200 dark:border-slate-700 px-3 py-4 text-sm">
                                <div class="h-10 w-10 rounded-lg bg-slate-100 dark:bg-slate-800"></div>
                                <div>
                                    <p class="font-medium">Upload image</p>
                                    <p class="text-xs text-slate-500">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                            <input type="file" class="sr-only" data-field="image" />
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium">Description</label>
                        <textarea rows="4" class="mt-2 w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-3 py-2 text-sm" data-field="description" placeholder="Short product description"></textarea>
                        <p class="mt-1 text-xs text-slate-400">Optional summary shown in catalogs.</p>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-slate-200 dark:border-slate-800 pt-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="text-xs text-slate-500">Fields marked required follow the validation rules.</div>
                        <div class="flex gap-2">
                            <button type="button" class="rounded-lg border border-slate-200 dark:border-slate-700 px-4 py-2 text-sm" data-modal-close>Cancel</button>
                            <button type="button" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white" data-save-product>Save Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed inset-0 z-50 hidden" data-modal="delete">
            <div class="absolute inset-0 bg-slate-900/60" data-modal-close></div>
            <div class="absolute left-1/2 top-1/2 w-full max-w-md -translate-x-1/2 -translate-y-1/2 rounded-2xl bg-white dark:bg-slate-900 p-6 shadow-xl">
                <div class="flex items-start gap-4">
                    <div class="h-12 w-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                        <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 8a1 1 0 011-1h6a1 1 0 011 1v8a2 2 0 01-2 2H8a2 2 0 01-2-2V8zm2-5a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Delete product?</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">This action cannot be undone. Product history will remain for audits.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button class="rounded-lg border border-slate-200 dark:border-slate-700 px-4 py-2 text-sm" data-modal-close>Cancel</button>
                    <button class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-medium text-white" data-confirm-delete>Delete</button>
                </div>
            </div>
        </div>

        <div class="fixed bottom-6 right-6 z-50 hidden" data-toast>
            <div class="flex items-center gap-3 rounded-xl bg-slate-900 text-white px-4 py-3 shadow-lg">
                <div class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium" data-toast-title>Product saved</p>
                    <p class="text-xs text-slate-300" data-toast-body>Changes are now live.</p>
                </div>
                <button class="ml-2 text-slate-300 hover:text-white" data-toast-close>
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.707 5.293a1 1 0 00-1.414 1.414L8.586 10l-3.293 3.293a1 1 0 001.414 1.414L10 11.414l3.293 3.293a1 1 0 001.414-1.414L11.414 10l3.293-3.293a1 1 0 00-1.414-1.414L10 8.586 6.707 5.293z" />
                    </svg>
                </button>
            </div>
        </div>
    </body>
</html>
