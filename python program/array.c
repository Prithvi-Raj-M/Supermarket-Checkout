#include <stdio.h>
void main()
{
	int arr[50],odd[50],even[50];
	int i,j=0,k=0,n;
	printf("Enter the number of elements in the array : ");
	scanf("%d",&n);
	printf("\nEnter %d elements : ",n);
	for(i=0;i<n;i++)
	{
		scanf("%d",&arr[i]);
	}
	for(i=0;i<n;i++)
	{
		if(arr[i]%2==0)
		{
			even[j]=arr[i];
			j++;
		}
		else
		{
			odd[k]=arr[i];
			k++;
		}
	}
	printf("\nOdd Numbers Array : ");
	for(i=0;i<k;i++)
	{
		printf("%d   ",odd[i]);
	}
	printf("\n\nEven Numbers Array : ");
	for(i=0;i<j;i++)
	{
		printf("%d   ",even[i]);
	}
}
