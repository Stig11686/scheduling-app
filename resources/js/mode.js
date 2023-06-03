function mode(numbers) {
    var count = {};
    var maxCount = 0;
    var modes = [];

    // Count occurrences of each number
    for (var i = 0; i < numbers.length; i++) {
      var num = numbers[i];
      if (count[num] === undefined) {
        count[num] = 1;
      } else {
        count[num]++;
      }

      if (count[num] > maxCount) {
        maxCount = count[num];
      }
    }

    // Find numbers with the highest count (modes)
    for (var num in count) {
      if (count.hasOwnProperty(num) && count[num] === maxCount) {
        modes.push(parseFloat(num));
      }
    }

    return modes;
  }

  console.log(mode([1, 1, 1, 3, 5, 6, 6, 6, 10]));
