self.onmessage = async function (e) {
   const response = await fetch('https://dummyjson.com/users?limit=100');
   const data = await response.json();

   const users = data.users;
   let totalAge = 0;
   let males = 0;
   let females = 0;

   users.forEach(user => {
       totalAge += user.age;
       if (user.gender === "male") males++;
       if (user.gender === "female") females++;
   });

   const averageAge = (totalAge / users.length).toFixed(2);

   self.postMessage({
       averageAge,
       males,
       females,
       total: users.length
   });
};
