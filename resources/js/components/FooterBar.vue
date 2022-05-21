<template class="sticky top-[100vh]">
    <footer class="p-4 bg-white sm:p-6 dark:bg-gray-800">
        <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <a href="https://github.com/slashere" class="hover:underline">Fedorov Anton™</a>. All Rights Reserved.
        </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="https://github.com/slashere" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                </a>
            </div>
        </div>
    </footer>
</template>
<script>

export default {
    data() {
        return {
            mail : 'xavier.seignard+drangies@gmail.com',
            phone : '06.00.00.00.00',
            mention : '2018 | mentions légales'
        }
    },
}
</script>
<style scoped>
#container{
    position: fixed;
    padding-top: 20px;
    margin-top: 20px;
    bottom: 0;
    width: 100vw;
    color: black;
    background-color: whitesmoke;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.footer-distributed {
    position: fixed;
    bottom: 0;
    background-color: #292c2f;
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
    box-sizing: border-box;
    width: 100%;
    text-align: left;
    align-items: center;
    font: normal 16px sans-serif;
    padding: 23px 50px
}

.footer-distributed .footer-left p {
    color: #8f9296;
    font-size: 14px;
    margin: 0;
}
/* Footer links */

.footer-distributed p.footer-links {
    font-size: 18px;
    font-weight: bold;
    color: #ffffff;
    margin: 0 0 10px;
    padding: 0;
    transition: ease .25s;
}

.footer-distributed p.footer-links a {
    display: inline-block;
    line-height: 1.8;
    text-decoration: none;
    color: inherit;
    transition: ease .25s;
}

.footer-distributed .footer-links a:before {
    content: "·";
    font-size: 20px;
    left: 0;
    color: #fff;
    display: inline-block;
    padding-right: 5px;
}

.footer-distributed .footer-links .link-1:before {
    content: none;
}

.footer-distributed .footer-right {
    float: right;
    margin-top: 6px;
    max-width: 180px;
}

.footer-distributed .footer-right a {
    display: inline-block;
    width: 35px;
    height: 35px;
    background-color: #33383b;
    border-radius: 2px;
    font-size: 20px;
    color: #ffffff;
    text-align: center;
    line-height: 35px;
    margin-left: 3px;
    transition:all .25s;
}

.footer-distributed .footer-right a:hover{transform:scale(1.1); -webkit-transform:scale(1.1);}

.footer-distributed p.footer-links a:hover{text-decoration:underline;}
</style>
